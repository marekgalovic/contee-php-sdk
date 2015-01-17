<?php

namespace Contee\Interfaces;

interface MatchedInterface
{
	public function setType($type = "");
	public function setResource($resource = "");
	public function setItem(\Contee\Interfaces\ItemInterface $item);
	public function isGeneral();
	public function toArray();
	public function toJson();
	
}