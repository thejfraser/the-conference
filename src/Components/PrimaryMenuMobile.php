<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class PrimaryMenuMobile extends Abstraction implements Component {
	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		register_nav_menu('primary-mobile', __('Primary Mobile Menu', _TXTDOM));
		add_action('wp_update_nav_menu', array(__CLASS__, 'cacheClear'));
	}

	public static function cacheClear()
	{
		global $TheConference;
		if ($TheConference->hasCacher()) {
			$TheConference->getCacher()->delete(self::getCacheKeyStatic());
		}
	}

	public function render()
	{
		global $TheConference;
		if ($TheConference->hasCacher()){
			$html = $TheConference->getCacher()->get($this->getCacheKey());
			if ($html) {
				echo $html;
				return;
			}
		}

		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object($locations['primary-mobile']);
		$menuItems = wp_get_nav_menu_items($menu->term_id);
		$html = $this->buildMenu($menuItems);
		if ($TheConference->hasCacher()){
			$TheConference->getCacher()->set($this->getCacheKey(), $html, 604800);
		}
		echo $html;
	}

	private function buildMenu(Array $menuItems)
	{
		$menu = [];
		$menuMappings = [];
		while ($menuItem = array_shift($menuItems)) {
			$parent = $menuItem->menu_item_parent;
			$iD = $menuItem->ID;

			if ($parent == 0) {
				$menu[$iD] = [
					'item' => $menuItem,
					'children' => []
				];
				$menuMappings[$iD] = $menuItem;
			} else {
				$menuTrail = [];

				while ($parent > 0) {
					$thisParent = $menuMappings[$parent];
					$parent = $thisParent->menu_item_parent;
					array_unshift($menuTrail, $thisParent);					
				}
				$theMenu = &$menu;

				while ($x = array_shift($menuTrail)) {
					$theMenu = &$theMenu[$x->ID]['children'];
				}

				$theMenu[$iD] = [
					'item' => $menuItem,
					'children' => []
				];
				$menuMappings[$iD] = $menuItem;
				unset($theMenu);
			}
		}
		$html = $this->walkMenu($menu);
		return $html;
	}

	private function walkMenu($menu) {
		if (count($menu) == 0) {
			return '';
		}

		$html = "<ul class='collapsible side-nav'>";

		foreach ($menu as $menuItem)
		{

			if (count($menuItem['children']) == 0) {
				$html .= $this->getLinkHTML($menuItem['item'], 0);
			} else {
				$html .= '<li class="no-padding">';
				$html .= '<a href="#" class="grey-text collapsible-header">' . $menuItem['item']->title . '</a>';
				$html .= '<div class="collapsible-body"><ul>';
				$html .= $this->getLinkHTML($menuItem['item'], 0);
				$html .= $this->walkSubMenu($menuItem['children'], 0);
				$html .= '</ul></div></li>';
			}
		}

		$html .= '</ul>';

		return $html;
	}

	private function walkSubMenu($subMenu, $level = 0)
	{
		if (count($subMenu) == 0) {
			return '';
		}
		$html = '';

		foreach ($subMenu as $menuItem) {
			$html .= $this->getLinkHTML($menuItem['item'], $level);
			$html .= $this->walkSubMenu($menuItem['children'], $level+1);
		}
		return $html;
	}


	private function getLinkHTML($menuItem, $level = 0)
	{
		$target = '';
		if ($menuItem->target != '') {
			$target = ' target="' . $menuItem->target . '"';
		}
		$title = '';
		if ($menuItem->attr_title != '') {
			$title = ' title="' . $menuItem->attr_title . '"';
		}
		$linkPrefix = '';
		if ($level > 0) {
			$linkPrefix = str_repeat(" - ", $level);
		}
		return sprintf(
			'<li class="no-padding"><a href="%s"%s%s>%s%s</a></li>',
			$menuItem->url,
			$target,
			$title,
			$linkPrefix,
			$menuItem->title
		);
	}
}