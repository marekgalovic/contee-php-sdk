<?php

namespace Contee;

class Contee implements \Contee\Interfaces\SdkInterface{

	private $request;
	private $cache;
	
	public function __construct(\Contee\Interfaces\AuthInterface $auth)
	{	
		$this->request = new \Contee\Request\Request($auth);
		$this->cache = \Contee\Cache\Cache::instance();
	}
	
	//creators
	public function createNewsletter()
	{
		return new \Contee\Newsletter;	
	}
	
	public function createMessage()
	{
		return new \Contee\Message;	
	}
	
	public function createItem()
	{
		return new \Contee\Item;
	}
	
	public function createMatched()
	{
		return new \Contee\Matched;	
	}
	
	/*
		get api route acoording to documentation 
	*/
	public function get($route, $options = array())
	{
		return $this->request->get($route, $options)->safe()->make();
	}
	
	//newsletter 
	public function sendNewsletter(\Contee\Interfaces\NewsletterInterface $newsletter)
	{
		return $this->request->post("/newsletter/send", $newsletter->toArray())->safe()->make();
	}
	
	//matched 
	public function getMatched(\Contee\Interfaces\MatchedInterface $matched)
	{
		if($matched->isFlushed()){
			$this->request->post("/matched/flush", $matched->toArray())->make();
		}
		$option = $matched->isGeneral() ? "general" : "resource";
		if($this->cache->has($matched->getInfo())){
			return new \Contee\Response\Response($this->cache->get($matched->getInfo()));
		}else{
			$response = $this->request->post("/matched/".$option, $matched->toArray())->make();
			if(!$response->toJson())
			{
				$response = new \Contee\Response\Response($matched->toJson());
			}
			$this->cache->setex($matched->getInfo(), 3600, $response->toJson());
			return $response;
		}
	}
	
}

?>