<?php
namespace TheConference;

use TheConference\Classes\SetUp as SetUp;
use TheConference\Classes\Options as Options;
use TheConference\Interfaces\Cacher as Cacher;

class TheConference {

	protected $directoryPath;
	protected $cacher = false;
	protected $components;
	protected $extensions;
	public $options;

	public function __construct($directoryPath)
	{
		$this->directoryPath = $directoryPath;
		$this->options = Options::load($this->getCachePath());
	}

	public function assignCacher(Cacher $cacher)
	{
		$this->cacher = $cacher;
	}

	public function getCacher()
	{
		return $this->cacher;
	}

	public function hasCacher()
	{
		return $this->cacher !== false;
	}

	public function runSetup($admin)
	{
		SetUp::run($admin);
	}

	public function getCachePath()
	{
		return trailingslashit($this->directoryPath) . 'cache/';
	}

	public function registerComponent($name, $component)
	{
		$cString = 'TheConference\Components\\' . $component;
		if (!class_exists($cString)) {
			throw new Exception('Attempting to register unknown Component: ' . $component);
		}
		$this->components[strtolower($name)] = call_user_func($cString . '::readyUp');
	}

	public function isComponentRegistered($name)
	{
		return isset($this->components[$name]);
	}

	public function getComponent($name)
	{
		$name = strtolower($name);
		if (!$this->isComponentRegistered($name)) {
			throw new Exception('Component Not Found: ' . $name);
		}
		return $this->components[$name];
	}

	public function registerExtension($name, $extension)
	{
		$cString = 'TheConference\Extensions\\' . $extension;
		if (!class_exists($cString)) {
			throw new Exception('Attempting to register unknown Extension: ' . $extension);
		}
		$this->extensions[strtolower($name)] = call_user_func($cString . '::readyUp');
	}

	public function isExtensionRegistered($name)
	{
		return isset($this->extensions[$name]);
	}

	public function getExtension($name)
	{
		$name = strtolower($name);
		if (!$this->isExtensionRegistered($name)) {
			throw new Exception('Extension Not Found: ' . $name);
		}
		return $this->extensions[$name];
	}
}