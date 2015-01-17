<?php

namespace Contee\Interfaces;

interface AuthInterface
{	
	public function getAppId();
	
	public function getClientId();
	
	public function getClientSecret();
	
	public function getToken();
}