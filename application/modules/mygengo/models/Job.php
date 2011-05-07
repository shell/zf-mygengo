<?php

class Mygengo_Model_Job extends Mygengo_Model_Api
{		
	static function find($job_id) {
		$job = myGengo_Api::factory('job');
		$job->getJob($job_id, 'json');
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response->job;
	}     
	
	static function create($params) {
		$job = myGengo_Api::factory('job');
		$job->postJob($params);
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;		
	}                       
			
	static function revise($job_id, $comment) {
		$job = myGengo_Api::factory('job');       
		$job->revise($job_id, $comment);
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;		
	}               
	
	static function approve($id, $params) {
		$job = myGengo_Api::factory('job');
		$job->approve($id, $params);
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;
	}               
	
	static function reject($id, $params) {
		$job = myGengo_Api::factory('job');
		$job->reject($id, $params);
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;
	}               
	
	static function delete($job_id) {
		$job = myGengo_Api::factory('job');
		$job->cancel($job_id, 'json');
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;		
	}               
	
	static function preview($id) {
		$job = myGengo_Api::factory('job');
		$job->previewJob($id);
		self::check_for_errors($job);
		$stream = $job->getResponseBody();
		
		$fn = md5(count($stream)).'.jpg';
    $fpath = dirname(__FILE__) . '/../../../../public/images/mygengo/' . $fn;
		// die($fpath);
		$fh = fopen($fpath, 'w');
		fwrite($fh, $stream);
		fclose($fh);		                           
		
		return $fn;
	}
	
	static function create_comment($id, $body) {
		$job = myGengo_Api::factory('job');
		$job->postComment($id, $body);
		self::check_for_errors($job);
		$response = self::parseRequest($job);
		return $response;		
	}               
	
	static function comments($job_id) {         
 		$job = myGengo_Api::factory('job');
	  $job->getComments($job_id, 'json');
	  self::check_for_errors($job);
	  $response = self::parseRequest($job);
	  return $response->thread;	  
	}                               
	
	static function feedback($job_id) {
		$job = myGengo_Api::factory('job');
	  $job->getFeedback($job_id, 'json');
	  self::check_for_errors($job);
	  $response = self::parseRequest($job);
	  return $response->feedback;	   		
	}
	
	static function revisions($job_id) {
		$job = myGengo_Api::factory('job');
	  $job->getRevisions($job_id, 'json');
	  self::check_for_errors($job);
	  $response = self::parseRequest($job);		
	  return is_array($response->revisions) ? $response->revisions : array($response->revisions);	  		
	}      
	
	static function revision($job_id, $id) {
	 	$job = myGengo_Api::factory('job');
	  $job->getRevision($job_id, $id, 'json');
	  self::check_for_errors($job);
	  $response = self::parseRequest($job);
	  return $response->revision;	  			 
	}
	
	
}