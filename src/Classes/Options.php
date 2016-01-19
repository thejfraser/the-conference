<?php
namespace TheConference\Classes;

class Options {
	const OPTION_DATABASE_NAME = 'theconference-options';
	const OPTION_CACHE_FILE_NAME = 'Tc-Opt.json';

	protected $options;
	private $cachePath;


	public static function load($cachePath)
	{
		if (self::cacheFileExists($cachePath)) {
			return new static(self::loadFromFile($cachePath), $cachePath);
		}
		$options = self::loadFromDatabase();
		self::cacheOptions($cachePath, $options);
		return new static($options, $cachePath);
	}

	public function getAll()
	{
		return $this->options;
	}

	public function get($optionName)
	{
		return $this->options[strtolower($optionName)] ? : false;
	}

	public function set($optionName, $optionValue)
	{
		$this->options[strtolower($optionName)] = $optionValue;
	}

	public function save()
	{
		update_option(self::OPTION_DATABASE_NAME, $this->options);
		self::cacheOptions($this->cachePath, $this->options);
	}

	private function __construct(Array $options, $cachePath)
	{
		$this->options = $options;
		$this->cachePath = $cachePath;
	}

	private static function loadFromDatabase()
	{
		return get_option(self::OPTION_DATABASE_NAME, array());
	}

	private static function cacheOptions($directory, Array $options)
	{
		return file_put_contents($directory . self::OPTION_CACHE_FILE_NAME, json_encode($options));
	}

	private static function loadFromFile($directory)
	{
		return json_decode(file_get_contents($directory . self::OPTION_CACHE_FILE_NAME), true);
	}

	private static function cacheFileExists($directory)
	{
		return file_exists($directory . self::OPTION_CACHE_FILE_NAME);
	}

}