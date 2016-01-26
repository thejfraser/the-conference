<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class FooterWidgetArea extends Abstraction implements Component {

	const WIDGET_ID = 'footer_widget_area';

	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
		add_action( 'widgets_init', array(__CLASS__, 'widgetInit') );
	}

	public static function widgetInit()
	{
		register_sidebar( array(
			'name'          => __('Footer Widget Area', _TXTDOM),
			'id'            => self::WIDGET_ID,
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="rounded">',
			'after_title'   => '</h2>',
		) );
	}

	public function render()
	{
		dynamic_sidebar(self::WIDGET_ID);
	}
}