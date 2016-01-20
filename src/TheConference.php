<?php
namespace TheConference;

use TheConference\Classes\SetUp as SetUp;
use TheConference\Classes\Options as Options;
use TheConference\Interfaces\Component as Component;

class TheConference {

	protected $directoryPath;
	protected $components;
	public $options;

	public function __construct($directoryPath)
	{
		$this->directoryPath = $directoryPath;
		$this->options = Options::load($this->getCachePath());
	}

	public function runSetup($admin)
	{
		SetUp::run($admin);
	}

	public function getCachePath()
	{
		return trailingslashit($this->directoryPath) . 'cache/';
	}

	public function registerComponent($name, Component $component)
	{
		$this->components[strtolower($name)] = $component;
	}

	public function getComponent($name)
	{
		$name = strtolower($name);
		if (!isset($this->components[$name])) {
			throw new Exception('Component Not Found: ' . $name);
		}

		return $this->components[$name];
	}
}