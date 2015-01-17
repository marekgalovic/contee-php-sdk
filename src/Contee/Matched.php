<?php

namespace Contee;

class Matched implements \Contee\Interfaces\MatchedInterface
{

	private $request = array("items" => array(), "resource"=>"");
	
	public function __construct()
	{
		$this->checkCookie();
	}
	
	public function setType($type = "")
	{
		$this->request["type"] = strval($type);
	}
	
	public function setResource($resource = "")
	{	
		$this->request["resource"] = strval($resource);
	}
	
	public function setItem(\Contee\Interfaces\ItemInterface $item)
	{
		array_push($this->request["items"], $item->get());
	}
	
	private function checkCookie()
	{
		if(empty($this->request["resource"])){
			$this->request["resource"] = $_COOKIE["_statz_tracker"] ? $_COOKIE["_statz_tracker"] : "";
		}
	}
	
	public function isGeneral()
	{
		return empty($this->request["resource"]);	
	}
	
	public function toArray()
	{
		return $this->request;
	}
	
	public function toJson()
	{
		return json_encode($this->toArray());
	}
	
}