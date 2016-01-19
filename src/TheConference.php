<?php
namespace TheConference;

use TheConference\Classes\SetUp as SetUp;
use TheConference\Classes\Options as Options;

class TheConference {

	protected $directoryPath;
	public $options;

	public function __construct($directoryPath)
	{
		$this->directoryPath = $directoryPath;
		$this->options = Options::load($this->getCachePath());
	}

	public function runSetup()
	{
		SetUp::run();
	}

	public function getCachePath()
	{
		return trailingslashit($this->directoryPath) . 'cache/';
	}
}