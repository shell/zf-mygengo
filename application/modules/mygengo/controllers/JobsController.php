<?php

class Mygengo_JobsController extends Add_BaseController
{
	private $jobs;
	
	public function indexAction() {
		$job_ids = Mygengo_Model_Jobs::all();
		$jobs = array();
		foreach ($job_ids as $job_i) {                    
			$job = Mygengo_Model_Job::find($job_i->job_id);
			$job->comments = Mygengo_Model_Job::comments($job_i->job_id);
			$jobs []= $job;
		}
	
		$this->view->jobs = $jobs;
	} 
	
	public function newAction() {
		$languages = Mygengo_Model_Service::languages();
		$language_pairs = Mygengo_Model_Service::language_pairs();
		$lc_src = array();
		$lc_tgt = array();
	
		foreach($language_pairs as $lp) {
			
			if (!in_array($lp->lc_src, $lc_src)) {
				foreach ($languages as $k => $v) {
					if ($v->lc == $lp->lc_src) {
						$lc_src = array_merge($lc_src, array($v->lc => $v->language));
					}
				}					
			}
			if (!in_array($lp->lc_tgt, $lc_src)) {
				foreach ($languages as $k => $v) {
					if ($v->lc == $lp->lc_tgt) {
						$lc_tgt = array_merge($lc_tgt, array($v->lc => $v->language));
					}
				}					
			}
		}
		
		$this->view->lc_src = $lc_src;
		$this->view->lc_tgt = $lc_tgt;
	}
	
	public function createAction() {
 		$job = $this->getRequest()->getParam('job');
		if (!is_null($job)) {                     
			if (empty($job['callback_url'])) {
				$job = array_remove_keys($job, 'callback_url');
			}
			Mygengo_Model_Job::create($job);
		  $this->_helper->_redirector->gotoSimple('index','jobs'); 
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
	} 
	
	public function showAction() {  
    $job_id    = $this->getRequest()->getParam('id');
		if (!is_null($job_id)) {
			$job = Mygengo_Model_Job::find($job_id);
			$job->comments = Mygengo_Model_Job::comments($job_id);	 
			$job->feedback = Mygengo_Model_Job::feedback($job_id);	 
			$job->revisions = Mygengo_Model_Job::revisions($job_id);	 
	 		// var_dump($job->revisions);	
			$this->view->job = $job;
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
	}      
	
	public function revisionAction() {
		$job_id    = $this->getRequest()->getParam('id');
		$rev_id    = $this->getRequest()->getParam('rev_id');
    if (!is_null($job_id) && !is_null($rev_id)) {
	 		$revision = Mygengo_Model_Job::revision($job_id, $rev_id);	

			$this->view->job_id = $job_id;
			$this->view->revision = $revision;
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
	}       
	
	public function cancelAction() {
		$job_id    = $this->getRequest()->getParam('id');

		if (!is_null($job_id)) {
	 		Mygengo_Model_Job::delete($job_id);			
			$this->_helper->_redirector->gotoSimple('index','jobs');
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
	} 
	
	public function reviewAction() {
		$job_id    = $this->getRequest()->getParam('id');
		if (!is_null($job_id)) {
			$job = Mygengo_Model_Job::find($job_id);
			if (!is_null($job) && $job->status == 'reviewable') {
				$preview 	= Mygengo_Model_Job::preview($job_id);
	      $job->comments = Mygengo_Model_Job::comments($job_id); 

				$this->view->job = $job;
				$this->view->preview = $preview;
			} else {
				throw new Zend_Controller_Action_Exception('Not viewewable', 404);
			}			
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
	}     
	
	public function rejectAction() {
		$job_id    = $this->getRequest()->getParam('id');
		if (!is_null($job_id)) {
			$job = Mygengo_Model_Job::find($job_id);
			if (!is_null($job) && $job->status == 'reviewable') {
				$preview 	= Mygengo_Model_Job::preview($job_id);
	      $job->comments = Mygengo_Model_Job::comments($job_id); 

				$this->view->job = $job;
				$this->view->preview = $preview;
			} else {
				throw new Zend_Controller_Action_Exception('Not viewewable', 404);
			}			
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}
		
	} 
	
	public function reviseAction() {
		$job_id    = $this->getRequest()->getParam('id');
		if (!is_null($job_id)) {
			$job = Mygengo_Model_Job::find($job_id);
			if (!is_null($job) && $job->status == 'reviewable') {
				$preview 	= Mygengo_Model_Job::preview($job_id);
	      $job->comments = Mygengo_Model_Job::comments($job_id); 

				$this->view->job = $job;
				$this->view->preview = $preview;
			} else {
				throw new Zend_Controller_Action_Exception('Not viewewable', 404);
			}			
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}		
	}                           
	
	public function approveAction() {
		$id    = $this->getRequest()->getParam('id');
		$payload    = $this->getRequest()->getParam('job');
		if (!is_null($id)) {
			try {
				Mygengo_Model_Job::approve($id, $payload);
			} catch (myGengo_Exception $e) {
				$this->_helper->flashMessenger->addMessage($e->getMessage());
			}
			$this->_helper->_redirector->gotoSimple('show','jobs', null, array('id' => $id));		
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}		
	} 
	
	public function revisepostAction() {                      
		$job_id    = $this->getRequest()->getParam('id');
		$comment    = $this->getRequest()->getParam('comment');
		if (!is_null($job_id) && !is_null($comment)) {
			try {
				Mygengo_Model_Job::revise($job_id, $comment);
			} catch (myGengo_Exception $e) {
				$this->_helper->flashMessenger->addMessage($e->getMessage());
			}
			$this->_helper->_redirector->gotoSimple('show','jobs', null, array('id' => $job_id));		
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}		
	} 
	
	public function rejectpostAction() {
		$id    = $this->getRequest()->getParam('id');
		$payload    = $this->getRequest()->getParam('job');
		if (!is_null($id)) {
			try{
				Mygengo_Model_Job::reject($id, $payload);
			} catch (myGengo_Exception $e) {
				$this->_helper->flashMessenger->addMessage($e->getMessage());
			}
			$this->_helper->_redirector->gotoSimple('show','jobs', null, array('id' => $id));		
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}		
	}       
	
	public function createcommentAction() {
		$id    = $this->getRequest()->getParam('id');
		$body    = $this->getRequest()->getParam('body');
		if (!is_null($id)) {
			try {
				Mygengo_Model_Job::create_comment($id, $body);
			} catch (myGengo_Exception $e) {
				$this->_helper->flashMessenger->addMessage($e->getMessage());
			}
			$this->_helper->_redirector->gotoSimple('show','jobs', null, array('id' => $id));		
		} else {
			throw new Zend_Controller_Action_Exception('Not found', 404);
		}		
		
	}
  			
}


function array_remove_keys($array, $keys = array()) { 
  
    // If array is empty or not an array at all, don't bother 
    // doing anything else. 
    if(empty($array) || (! is_array($array))) { 
        return $array; 
    } 
  
    // If $keys is a comma-separated list, convert to an array. 
    if(is_string($keys)) { 
        $keys = explode(',', $keys); 
    } 
  
    // At this point if $keys is not an array, we can't do anything with it. 
    if(! is_array($keys)) { 
        return $array; 
    } 
  
    // array_diff_key() expected an associative array. 
    $assocKeys = array(); 
    foreach($keys as $key) { 
        $assocKeys[$key] = true; 
    } 
  
    return array_diff_key($array, $assocKeys); 
} 
