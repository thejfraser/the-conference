<?php
namespace TheConference\Components;
abstract class Abstraction {

	protected function getCacheKey()
	{
		return self::getCacheKeyStatic();
	}

	protected static function getCacheKeyStatic()
	{
		return 'COMPONENT-' . (@array_pop(@explode("\\", get_class(new static))));	
	}

}