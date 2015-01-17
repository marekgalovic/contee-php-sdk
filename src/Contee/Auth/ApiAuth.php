<?php

namespace Contee\Auth;

class ApiAuth implements \Contee\Interfaces\AuthInterface
{
	private $appId;
	private $clientId;
	private $clientSecret;
	private $bearerToken;
	
	private $cache;

	public function __construct($appId, $clientId = null, $clientSecret = null)
	{
		$this->appId = $appId;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->cache = \Contee\Cache\Cache::instance();
		return $this;
	}
	
	private function authenticate()
	{
		if(!$this->cache->has("bearertoken")){
			$request = new \Contee\Request\Request($this);
			$request->post("/oauth/token", array());
			$request->setCustomHeader("client_id", $this->getClientId());
			$request->setCustomHeader("client_secret", $this->getClientSecret());
			$response = $request->make()->toObject();
			if($response !== false){
				$this->cache->setex("bearertoken", 100, $response->token);
			}
		}
		return $this->cache->get("bearertoken");
	}
	
	public function getAppId()
	{
		return $this->appId ? $this->appId : "";
	}
	
	public function getClientId()
	{
		return $this->clientId;
	}
	
	public function getClientSecret()
	{
		return $this->clientSecret;
	}
	
	public function getToken()
	{
		return $this->authenticate();
	}
}