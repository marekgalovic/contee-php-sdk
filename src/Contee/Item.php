<?php

namespace Contee;

class Item implements \Contee\Interfaces\ItemInterface
{
	private $tags;
	
	private $data = array();
	
	public function setTags($tags)
	{
		if(!is_array($tags)){
			$tags = array($tags);
		}
		$this->tags = $tags;
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
		return $this->data;
	}
}