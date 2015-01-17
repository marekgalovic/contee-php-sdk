<?php

namespace Contee;

class Newsletter implements \Contee\Interfaces\NewsletterInterface
{

	private $newsletter = array("items" => array());
	
	public function setMessage(\Contee\Interfaces\MessageInterface $message)
	{
		$this->newsletter = array_merge($this->newsletter, $message->get());
	}
	
	public function setItem(\Contee\Interfaces\ItemInterface $item)
	{
		array_push($this->newsletter["items"], $item->get());
	}
	
	public function toArray()
	{
		return $this->newsletter;
	}
	
	public function toJson()
	{
		return json_encode($this->toArray());
	}
	
}