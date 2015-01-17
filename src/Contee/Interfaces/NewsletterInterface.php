<?php

namespace Contee\Interfaces;

interface NewsletterInterface{
	
	public function setMessage(\Contee\Interfaces\MessageInterface $message);
	
	public function setItem(\Contee\Interfaces\ItemInterface $item);
	
	public function toJson();
	
	public function toArray();
	
}