<?php

namespace Contee\Interfaces;

interface CacheInterface{

	public static function instance();
	
	public function set($key, $value);
	
	public function get($key, $default = null);
	
	public function setex($key, $expires, $value);
	
	public function has($key);
	
}