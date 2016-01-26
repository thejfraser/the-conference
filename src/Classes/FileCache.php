<?php
namespace TheConference\Classes;
use TheConference\Interfaces\Cacher;
use TheConference\Exceptions\CacheKeyException;

class FileCache implements Cacher {

	protected $basePath = '';

	public function __construct($basePath)
	{
		$this->basePath = $basePath;
	}

	public function get($key)
	{
		$filePath = $this->getFilePath($key);
		if (!file_exists($filePath)) {
			return false;
		}

		$fileContents = file_get_contents($filePath);
		$fileLineBreak = stripos($fileContents, PHP_EOL);
		$cacheTime = intval(substr($fileContents, 0, $fileLineBreak));
		$cacheContents = trim(substr($fileContents, $fileLineBreak));

		if ($cacheTime == 0) {
			return $cacheContents;
		}

		$expiryTime = (filemtime($filePath)) + $cacheTime;
		if ($expiryTime > date("U")) {
			return $cacheContents;
		}
		
		return false;
	}

	public function set($key, $value, $time)
	{
		$filePath = $this->getFilePath($key);

		$time = max(intval($time), 0);
		$fileContents = $time . PHP_EOL . trim($value);
		return file_put_contents($filePath, $fileContents);
	}

	public function delete($key)
	{
		$filePath = $this->getFilePath($key);
		return unlink($filePath);
	}

	private function getFilePath($key)
	{
		$key = strtolower($key);
		if (!$this->testKey($key)) {
			throw new \Exception('Unsafe Cache Key Detected');
		}
		return $this->basePath . $key . '.cache';
	}

	private function testKey($key)
	{
		return preg_match('/^[0-9a-z\_\-]{1,}$/', $key);
	}

}