<?php

namespace Contee\Interfaces;

interface MatchedInterface
{
	public function setType($type = "");
	public function getType();
	public function setResource($resource = "");
	public function getResource();
	public function getInfo();
	public function setItem(\Contee\Interfaces\ItemInterface $item);
	public function isGeneral();
	public function toArray();
	public function toJson();
	
}