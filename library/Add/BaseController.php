<?php

class Add_BaseController extends Zend_Controller_Action
{ 
	protected $_bootstrap;    	
	                          
	public function init() {
	    // get app boosttrap
  	$front = Zend_Controller_Front::getInstance();
  	$bootstrap = $front->getParam('bootstrap');
  	
  	// modules resource ArrayObject contains all bootstrap classes
  	// then get the bootstrap for this module (moduleconfig)
  	$this->_bootstrap = $bootstrap->getResource('modules')
  								  ->offsetGet('mygengo');     		
		
		$api_key = $this->_bootstrap->getOption('api_key');   
		$api_sig = $this->_bootstrap->getOption('private_key');   
		                   
		# Initialize static fields from config file
		Mygengo_Model_Api::set_api_key($api_key);
		Mygengo_Model_Api::set_api_sig($api_sig);
		Mygengo_Model_Api::$flash = $this->_helper->flashMessenger;
	} 
	
	public function postDispatch() {                                        
		$this->view->messages = $this->_helper->flashMessenger->getMessages();		
	}
	 
}