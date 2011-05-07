<?php
	class Add_LayoutLoader extends Zend_Controller_Action_Helper_Abstract
	{
 
		public  function preDispatch()
		{
			$bootstrap = $this -> getActionController()
			-> getInvokeArg('bootstrap');
			$config    = $bootstrap -> getOptions();
			$module    = $this -> getRequest()
			-> getModuleName();
 
			//если в application.ini для запрашиваемого модуля прописан layout
			//например blog.resources.layout.layout = blog, то устанавливаем его.
			if(isset($config[$module]['resources']['layout']['layout'])){
				$layoutScript = $config[$module]['resources']['layout']['layout'];
				$this -> getActionController()
				-> getHelper('layout')
				-> setLayout($layoutScript);
			}
		}
	}