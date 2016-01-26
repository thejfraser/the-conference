<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class PrimaryMenu extends Abstraction implements Component {
	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		register_nav_menu('primary', __('Primary Menu', _TXTDOM));
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

		$options = array(
			'theme_location'  => 'primary',
			'container'       => '',
			'menu_class'      => 'hide-on-small-only',
			'menu_id'         => 'primary-menu',
			'echo'            => 0,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 5,
		);

		$html = wp_nav_menu( $options );

		if ($TheConference->hasCacher()){
			$TheConference->getCacher()->set($this->getCacheKey(), $html, 604800);
		}

		echo $html;
	}
}