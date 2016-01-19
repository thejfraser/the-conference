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
$TheConference->runSetup();


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

function _TXTDOM() {
	return 'TheConference';
}