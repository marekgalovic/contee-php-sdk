<?php

namespace Contee\Request;

class Request implements \Contee\Interfaces\RequestInterface
{
	private $requestConfig = array(
		"url" => "http://api.conteeapp.com",
		"returnTransfer" => true,
		"headers" => array(
			"Content-Type: application/json",
		)
	);
	
	private $auth = null;
	private $ch = null;
	
	private $method = null;
	private $path = null;
	private $data = array();
	
	private $options = array();
	
	public function __construct(\Contee\Interfaces\AuthInterface $auth)
	{
		$this->auth = $auth;
		return $this;
	}
	
	public function get($path, $options = array())
	{
		$this->setOptions($options);
		return $this->create("GET", $path, array());
	}
	
	public function post($path, $data = array())
	{
		return $this->create("POST", $path, $data);
	}
	
	public function put($path, $data = array())
	{
		return $this->create("PUT", $path, $data);
	}
	
	public function delete($path, $options = array())
	{
		$this->setOptions($options);
		return $this->create("DELETE", $path, array());
	}
	
	private function create($method, $path, $data)
	{
		$this->method = $method;
		$this->path = $path;
		$this->data = $data;
		return $this->init();
	}
	
	private function getDataLength()
	{
		return strlen($this->getDataJson());
	}
	
	public function getMethod()
	{
		return strtoupper($this->method);
	}
	
	public function getOptions()
	{
		return $this->options;
	}
	
	private function getEncodedOptions()
	{
		return "?".http_build_query($this->getOptions());
	}
	
	public function getPath()
	{
		$routeArray = explode("/", $this->path);
		foreach($routeArray as $segmentIndex => $routeSegment)
		{
			if(array_key_exists($routeSegment, $this->getOptions()))
			{
				$routeArray[$segmentIndex] = $this->options[$routeSegment];
				unset($this->options[$routeSegment]);
			}
		}
		$this->path = implode("/", $routeArray);
		return $this->path;
	}
	
	public function getUrl()
	{
		return $this->requestConfig["url"].$this->getPath().$this->getEncodedOptions();
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	public function getDataJson()
	{
		return json_encode($this->getData());
	}
	
	public function getHeaders()
	{
		return $this->getConfigField("headers");
	}
	
	private function init()
	{
		$this->ch = curl_init($this->getUrl());
		return $this->setHeaders();	
	}
	
	private function setOptions($options)
	{
		$this->options = $options;
	}
	
	public function setCustomHeader($header, $value)
	{
		array_push($this->requestConfig["headers"], $header.": ".strval($value));
		return $this;	
	}
	
	private function getConfigField($field)
	{
		return isset($this->requestConfig[$field]) ? $this->requestConfig[$field] : '';
	}
	
	private function setHeaders()
	{
		$this->setCustomHeader("app_id", $this->auth->getAppId());
		return $this;
	}
	
	public function safe()
	{
		$this->setCustomHeader("authorization", "Bearer ".$this->auth->getToken());
		return $this;
	}
	
	public function make()
	{
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->getMethod());
		if(in_array($this->getMethod(), array("POST", "PUT")))
		{
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->getDataJson());
		}
		curl_setopt($this->ch, CURLOPT_FAILONERROR, false);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, $this->getConfigField("returnTransfer"));
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->getHeaders());
		return $this->exec();
	}
	
	private function exec()
	{
		$result = curl_exec($this->ch);
		return new \Contee\Response\Response($result);
	}
	
}