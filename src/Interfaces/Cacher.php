<?php
namespace TheConference\Interfaces;

interface Cacher {
	public function get($key);
	public function set($key, $value, $time);
	public function delete($key);
}