<?php

namespace Contee;

class Message implements \Contee\Interfaces\MessageInterface
{
	private $message = array("recipients" => array(), "custom" => array());
	
	private function isEmail($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		}
		return false;
	}

	public function setCustom($data)
	{
		if(is_array($data)){
			$this->message["custom"] = array_merge($this->message["custom"], $data);
		}
	}
	
	public function setFromEmail($email)
	{
		if($this->isEmail($email)){
			$this->message["from_email"] = $email;
		}
	}
	
	public function setFromName($name = "")
	{
		$this->message["from_name"] = $name;
	}
	
	public function setReplyTo($email)
	{
		if($this->isEmail($email)){
			$this->message["reply_to"] = $email;	
		}
	}
	
	public function setSubject($subject)
	{
		$this->message["subject"] = $subject;
	}
	
	public function setRecipients($recipients)
	{
		if(is_array($recipients)){
			$this->message["recipients"] = array_merge($this->message["recipients"], $recipients);
		}else{
			array_push($this->message["recipients"], $recipients);
		}
	}
	
	public function setTemplate($template = "")
	{
		$this->message["template"] = $template;	
	}
	
	public function get()
	{
		return $this->message;
	}
	
}