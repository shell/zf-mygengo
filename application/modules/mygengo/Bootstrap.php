<?php 

class Mygengo_Bootstrap extends Zend_Application_Module_Bootstrap {
  /**
   * Initialize module resources
   * 
   * @return mixed registry items
   */
	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Mygengo_',
            'basePath'  => dirname(__FILE__),
        ));
                
        return $autoloader;
    }
    
	/**
	 * Test to show returned values will go into container
	 * then they can be accessed by this resource method's name
	 * without the '_init' prefix that is (moduledata)
	 */
    protected function _initModuleData()
    {
    	$data = array(1,2,3,4,5,6,7,8,9,0);
    	return $data;
    }
    
	/**
     * Init config settings and resoure for this module
     * 
     */
    protected function _initModuleConfig()
    {
    	// load ini file
    	$iniOptions = new Zend_Config_Ini(dirname(__FILE__) . '/configs/mygengo.ini');    	
    	// Set this bootstrap options
    	$this->setOptions($iniOptions->toArray());    	
    }      

	
}