<?php

namespace Contee\Interfaces;

interface SdkInterface
{
	public function createNewsletter();
	public function createMessage();
	public function createItem();
	public function createMatched();
	public function get($route, $options = array());
	public function sendNewsletter(\Contee\Interfaces\NewsletterInterface $newsletter);
	public function getMatched(\Contee\Interfaces\MatchedInterface $matched);
}