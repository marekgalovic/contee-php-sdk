<?php

namespace Contee\Response;

class Response implements \Contee\Interfaces\ResponseInterface
{
	private $response;

	public function __construct($response)
	{
		$this->response = $response;
		return $this;
	}
	
	public function raw()
	{
		return $this->response;
	}
	
	public function toJson()
	{
		return $this->raw();
	}
	
	public function toArray()
	{
		return json_decode($this->toJson(), true);
	}
	
	public function toObject()
	{
		return json_decode($this->toJson());
	}

}