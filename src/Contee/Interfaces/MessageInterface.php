<?php

namespace Contee\Interfaces;

interface MessageInterface{

	public function setCustom($data);
	public function setFromEmail($email);
	public function setFromName($name);
	public function setReplyTo($email);
	public function setSubject($subject);
	public function setRecipients($recipients);
	public function setTemplate($template);
	public function get();
	
}