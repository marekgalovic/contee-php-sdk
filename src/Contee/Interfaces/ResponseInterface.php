<?php

namespace Contee\Interfaces;

interface ResponseInterface
{
	public function raw();
	public function toJson();
	public function toArray();
	public function toObject();
	
}