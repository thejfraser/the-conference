<?php
namespace TheConference\Interfaces;

interface Extension {
	public static function readyUp();
	public function initialize();
}