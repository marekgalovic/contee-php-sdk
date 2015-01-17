<?php

namespace Contee\Interfaces;

interface RequestInterface
{
	public function get($path);
	public function post($path, $data = array());
	public function put($path, $data = array());
	public function delete($path);
	public function getMethod();
	public function getPath();
	public function getUrl();
	public function getData();
	public function getDataJson();
	public function setCustomHeader($header, $value);
	public function getHeaders();
}