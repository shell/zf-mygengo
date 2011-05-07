<?php

class Mygengo_Model_Api
{    
	protected $_client; 
	static protected $api_key, $api_sig;
	static protected $messages = array();
	static public $flash;
	
	public static function setParams($params) {
		// create some default parameters
		$params = array('ts' => gmdate('U'), 'api_key' => self::$api_key);
		ksort($params);
		$query = http_build_query($params);
		$params['api_sig'] = myGengo_Crypto::sign($query, self::$api_sig);
		return $params;		
	}   
	
	public static function setPostParams($params) {
		$params = array('ts' => gmdate('U'), 'api_key' => self::$api_key,
										'_method' => 'post', 'data' => json_encode($data));
		ksort($params);
		$query = http_build_query($params);
		$params['api_sig'] = myGengo_Crypto::sign($query, self::$api_sig);
		return $params;				
	}

	public function parseRequest($client) {        
		$tmp = json_decode($client->getResponseBody());
		return $tmp->response;
	}                 
	
	public function set_api_key($api_key) {
		self::$api_key = $api_key;
	}

	public function set_api_sig($api_sig) {
		self::$api_sig = $api_sig;
	}                           	
	
	public static function check_for_errors($client) {
		$response = json_decode($client->getResponseBody());
		if (!is_null($response) && $response->opstat != 'ok') {
			// self::add_to_messages($response->err->msg);
			self::$flash->addMessage($response->err->msg);
		}
		return true;
	} 	

}

