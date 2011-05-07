<?php

class Mygengo_Model_Service extends Mygengo_Model_Api
{
	// protected $service;
		
	static function language_pairs() {
		$service = myGengo_Api::factory('service');
		$service->getLanguagePair('json');
		#check_for_errors();
		$response = self::parseRequest($service);
		return $response;
	}

	static function languages() {
		$service = myGengo_Api::factory('service');
		$service->getLanguages('json');
		#check_for_errors();
		$response = self::parseRequest($service);
		return $response;
	}
	

}

