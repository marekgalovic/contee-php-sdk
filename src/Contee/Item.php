<?php

namespace Contee;

class Item implements \Contee\Interfaces\ItemInterface
{
	private $tags = array();
	
	private $data = array();
	
	public function setTags($tags)
	{
		if(!is_array($tags)){
			array_push($this->tags, strval($tags));
		}
		$this->tags = array_merge($this->tags, $tags);
	}
	
	public function setData($data)
	{
		if(!is_array($data)){
			$data = array($data);
		}
		$this->data = $data;
	}
	
	public function get()
	{
		$this->data["tags"] = $this->tags;
		return (object) $this->data;
	}
}