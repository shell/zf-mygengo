<?php
class Mygengo_AccountController extends Add_BaseController
{
    private $account;		

    public function indexAction()
    {
			$this->view->balance = Mygengo_Model_Account::getBalance(array());
			$this->view->stats = Mygengo_Model_Account::getStats(array());
			$this->view->user_since = new Zend_Date(Mygengo_Model_Account::getStats(array())->user_since);			
    }       		               

}

