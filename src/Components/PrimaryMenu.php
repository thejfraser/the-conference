<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class PrimaryMenu implements Component {
	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		register_nav_menu('primary', __('Primary Menu', _TXTDOM));
	}

	public function render()
	{
		$options = array(
			'theme_location'  => 'primary',
			'container'       => '',
			'menu_class'      => 'hide hide-on-small-only',
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

		return wp_nav_menu( $options );
	}
}