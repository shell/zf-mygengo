<?php
class Mygengo_Model_Account extends Mygengo_Model_Api
{
	// protected $account;
		
  static function getBalance($params) {
		$account = myGengo_Api::factory('account');
		$account->getBalance('json', self::setParams($params));
		self::check_for_errors($account);
		$response = self::parseRequest($account);
		return $response->credits;
	}

	static function getStats($params) {
		$account = myGengo_Api::factory('account');
		$account->getStats('json', self::setParams($params));
		self::check_for_errors($account);
		$response = self::parseRequest($account);
		return $response;
	}

}

