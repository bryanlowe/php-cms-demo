<?php
namespace Framework\_engine\_core;

/**
 * Class: MVC
 *    
 * Abstract class that processes page requests, instantiates site configurations and captures the URI
 */
abstract class MVC {   
   
   /**
    * The instance of Config class.
    * 
    * @var    Config
    * @access protected            
    */       
   protected $config = null;
   
   /**
    * The instance of URI class.
    * 
    * @var    URI
    * @access protected            
    */       
   protected $uri = null;
   
   /**
    * The array as a result of merging of GET, POST and FILES data.
    * 
    * @var    array
    * @access protected            
    */       
   protected $pageRequests = null;

   /**
    * Constructs a new MVC object.
    * 
    * @access public        
    */       
   public function __construct() {
      $this->config = Register::getInstance()->get('config');
      Register::getInstance()->pageRequests = $this->pageRequests = array_merge($_GET, $_POST, $_FILES);
      Register::getInstance()->uri = $this->uri = new URI();
   }

   /**
    * Returns the instance of a Page class that associated with a page's URL.
    *            
    * @return Page   
    * @access public   
    * @abstract
    */       
   abstract public function getPage();


   /**
    * Launches the sequence of calls of page-class's methods. 
    * 
    * @param Page $page    
    * @access public                
    */       
   public function execute(IPage $page = null) {
      $page = ($page) ? $page : $this->getPage();
      Register::getInstance()->page = $page;
      if(!isset($this->pageRequests['_ajaxFunc'])){
        $page->init();
        $page->show();
      } else {
        $page->{$this->pageRequests['_ajaxFunc']}($this->pageRequests);
      }     
   }
}
?>