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

$TheConference->registerComponent('primary-menu', \TheConference\Components\PrimaryMenu::readyUp());
$TheConference->registerComponent('primary-menu-mobile', \TheConference\Components\PrimaryMenuMobile::readyUp());


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

function _TXTDOM() {
	return 'the-conference';
}