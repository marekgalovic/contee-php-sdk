<?php

namespace Contee\Cache;

class Cache implements \Contee\Interfaces\CacheInterface{

	private $sessionKey;
	
	private static $instance = null;
	
	public static function instance()
	{
		if(self::$instance == null){
			self::$instance = new \Contee\Cache\Cache;
		}
		return self::$instance;
	}
	
	private function __construct()
	{
		$this->sessionKey = md5("contee");	
	}
	
	public function set($key, $value)
	{
		$record = new \StdClass;
		$record->value = $value;
		$record->expires = null;
		return $_SESSION[$this->sessionKey][md5($key)] = $record;
	}
	
	public function setex($key, $expires, $value)
	{
		$date = new \DateTime();
		$date->add(new \DateInterval("PT".intval($expires)."S"));
		$record = new \StdClass;
		$record->value = $value;
		$record->expires = $date->getTimestamp(); 
		return $_SESSION[$this->sessionKey][md5($key)] = $record;
	}
	
	public function get($key, $default = null)
	{
		return $this->has($key) ? $_SESSION[$this->sessionKey][md5($key)]->value : $default;
	}
	
	public function has($key)
	{
		if(isset($_SESSION[$this->sessionKey][md5($key)])){
			$record = $_SESSION[$this->sessionKey][md5($key)];
			if($record->expires !== null){
				if(time() >= $record->expires){
					return false;
				}		
			}
			return true;
		}
		return false;
	}
	
}