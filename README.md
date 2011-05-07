## Introduction
  ZF-Mygengo is Zend Framework module for MyGengo(<http://mygengo.com/>)
   
## Installation       
  Copy archive contents in your zend framework application folder
  
  Add few configuration options to your `configs/application.ini`
  
    resources.frontController.moduleDirectory = APPLICATION_PATH "/modules"
    resources.modules[] = ""
    autoloaderNamespaces[] = "Add_"    
    autoloaderNamespaces[] = "myGengo_"    
    mygengo.resources.layout.layout = "mygengo"  

  Set up your Api and Private key in `application/modules/mygengo/configs/mygengo.ini`
              
## Quickstart from scratch

  * Start by downloading ZendFramework from Official Site(<http://framework.zend.com/download/latest>)
    I have downloaded version "Zend Framework 1.11.3 Full"
  * Unpack contents to a directory where you can quick access in example `~/Sites/zf`
  * Now either add `~/Sites/zf/bin` to your PATH or run it via relative path
  * Create quickstart project 
  
        cd ~/Sites
        sh ./zf/bin/zf.sh create project quickstart
    
  * Add symlink to a Zend framework library
  
        cd quickstart/library
        ln -s ~/Sites/zf/library/Zend .      
    
  * Enable layout
  
        cd ~/Sites/quickstart
        sh ../zf/bin/zf.sh enable layout
  
  * Checkout source zf-mygengo source code 
  
        cd ~/Sites
        git clone git@github.com:shell/zf-mygengo.git

    or download it from download section
    
  * Unpack contents in your quickstart folder
  
        cp -R zf-mygengo/ quickstart/
  
  * Put your API and Private Key to `quickstart/application/modules/configs/mygengo.ini`
    
  * Add following options to [Production] section in `quickstart/application/configs/application.ini`
  
        resources.frontController.moduleDirectory = APPLICATION_PATH "/modules"
        resources.modules[] = ""
        autoloaderNamespaces[] = "Add_"    
        autoloaderNamespaces[] = "myGengo_"    
        mygengo.resources.layout.layout = "mygengo"                            
    
  * Configure your server's htdocs to `~/Sites` or as in my case /Applications/MAMP/htdocs
  
  * You're all set to go! Check out page(<http://localhost/quickstart/public/mygengo/>)

  
## Usage                                                          
  Module uses `application/layouts/scripts/mygengo.phtml` layout

  By default routes will be nested in /mygengo path
  Example (<http://localhost:3000/mygengo/>)

## TODO               
* placeholder

## Author
Copyright (c) 2011 Vladimir Penkin
