<?php
namespace TheConference\Interfaces;

interface Component {
	public static function readyUp();
	public function initialize();
	public function render();
}