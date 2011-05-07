<?php

class Mygengo_Model_Jobs extends Mygengo_Model_Api
{
	// protected $jobs;
		
	static function all() {		
		$jobs = myGengo_Api::factory('jobs');
		$jobs->getJobs(array(), 'json');
		self::check_for_errors($jobs);
		$response = self::parseRequest($jobs);
		return $response;
	}
	
	static function by_group($group_id = 1) {
		$jobs = myGengo_Api::factory('jobs');
		$jobs->getGroupedJobs($group_id, 'json');
		self::check_for_errors($jobs);
		$response = self::parseRequest($jobs);
		return $response;		
	}                                 
			
}

