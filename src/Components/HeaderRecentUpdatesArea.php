<?php
namespace TheConference\Components;
use TheConference\Interfaces\Component;

class HeaderRecentUpdatesArea extends Abstraction implements Component {

	public static function readyUp()
	{
		$instance = new static();
		$instance->initialize();
		return $instance;
	}

	public function initialize()
	{
	}

	public function render()
	{

	}
}