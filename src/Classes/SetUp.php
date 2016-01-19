<?php
namespace TheConference\Classes;

class SetUp {

	private function __construct(){}

	public static function run($admin = false)
	{
		self::registerScripts();
		self::registerStyles();

		if (! $admin) {
			wp_enqueue_script('MaterializeJS');
			wp_enqueue_style('MaterializeCSS');
			wp_enqueue_style('MaterializeICONS');
			wp_enqueue_style('Theme');
		}
	}

	private static function registerScripts()
	{
		wp_register_script(
			'MaterializeJS', 
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js',
			array('jquery'),
			false,
			true
		);
	}

	private static function registerStyles()
	{
		wp_register_style(
			'MaterializeCSS',
			'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css'
		);

		wp_register_style(
			'MaterializeICONS',
			'https://fonts.googleapis.com/icon?family=Material+Icons',
			array('MaterializeCSS')
		);

		wp_register_style(
			'Theme',
			get_template_directory_uri() . '/style.css',
			array('MaterializeCSS')
		);
	}
}