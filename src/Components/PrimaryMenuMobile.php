<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class PrimaryMenuMobile implements Component {
	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		register_nav_menu('primary-mobile', __('Primary Mobile Menu', _TXTDOM));
	}

	public function render()
	{
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object($locations['primary-mobile']);
		$menuItems = wp_get_nav_menu_items($menu->term_id);
		$menu = $this->buildMenu($menuItems);
	}

	private function buildMenu(Array $menuItems)
	{
		$menu = [];
		while ($menuItem = array_shift($menuItems)) {
			$parent = $menuItem->menu_item_parent;
			var_dump($parent);
		}
		//we need to loop through and build up the menu, then from there we want to cache it because its a more complicated process
	}
}