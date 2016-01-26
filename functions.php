<?php
use TheConference\TheConference;
if (function_exists('spl_autoload_register')) {
	spl_autoload_register(function($class_name) {
		$path = dirname(__FILE__) . '/src/' . str_ireplace('\\', '/', str_ireplace('theconference\\', '', $class_name)) . '.php';
		require_once($path);
	});
}

global $TheConference;
$TheConference = new TheConference(dirname(__FILE__));
$TheConference->runSetup(is_admin());
$TheConference->assignCacher(new \TheConference\Classes\FileCache($TheConference->getCachePath()));

$TheConference->registerComponent('header-widget-area', 		'HeaderWidgetArea');
$TheConference->registerComponent('primary-menu', 				'PrimaryMenu');
$TheConference->registerComponent('primary-menu-mobile', 		'PrimaryMenuMobile');
$TheConference->registerComponent('left-sidebar-widget-area', 	'LeftSidebarWidgetArea');
$TheConference->registerComponent('right-sidebar-widget-area', 	'RightSidebarWidgetArea');
$TheConference->registerComponent('footer-widget-area',			'FooterWidgetArea');

$TheConference->registerExtension('recent-updates',				'RecentUpdatesPostType');


/**
 * TheConferenceGetOption
**/
function _TCGO($option, $default = '') {
	global $TheConference;
	return $TheConference->options->get($option) ? : $default;
}

/**
 * TheConferenceEchoOption
**/
function _TCEO($option, $default = '') {
	global $TheConference;
	echo $TheConference->options->get($option) ? : $default;
}

/**
 * TheConferenceComponentEcho
**/
function _TCCE($component)
{
	global $TheConference;
	echo $TheConference->getComponent($component)->render();
}
/**
 * TheConferenceComponentGet
**/
function _TCCG($component)
{
	global $TheConference;
	return $TheConference->getComponent($component)->render();
}

function _TXTDOM() {
	return 'the-conference';
}