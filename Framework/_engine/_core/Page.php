<?php
  namespace Framework\_engine\_core;
  
  /**
   * Class: Page
   *    
   * Abstract class that defines the page rendering functions of the site
   */ 
  abstract class Page{
     /**
      * Twig Loader Object
      * 
      * @var    templateLoader
      * @access protected            
      */
     protected $loader = null;

     /**
      * Twig Environment Object
      * 
      * @var    twig
      * @access protected            
      */
     protected $twig = null;

     /**
      * The name of the template file
      * 
      * @var    template
      * @access protected            
      */
     protected $template = '_common/base.html';

     /**
      * The array of the current pages modulized elements (HEADER, FOOTER, BODY, ... etc)
      * 
      * @var    pageElements
      * @access protected            
      */
     protected $pageElements = array();
     
     /**
      * Creates a Page object, gathers the registered utility instances for the pages use
      * 
      * @access public            
      */
     public function __construct(){
        $this->config = Register::getInstance()->get('config');
        $this->pageRequests = Register::getInstance()->get('pageRequests');
        $this->db = Register::getInstance()->get('db');
        $this->mongodb = Register::getInstance()->get('mongodb');
        $this->uri = Register::getInstance()->get('uri');
     }
     
     /**
      * Launches the page's initialization functions and sets each page element
      *              
      * @access public   
      * @abstract
      */ 
     abstract public function init();

     /**
      * Gathers all the page elements
      *              
      * @access protected   
      */
     protected function assemblePage(){       
        $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'));
     }
     
     
     /**
      * Retrieves any generic site template other than docheader, header, footer and body
      *  
      * @param string $template
      * @param string $source            
      * @access protected   
      */
     protected function setTemplate($template){
       $this->template = $template;
     }
     
     /**
      * Sets up the Title tag for the site
      *      
      * @param string $title
      * @access protected   
      */
     protected function setTitle($title){
        $this->setDisplayVariables('TITLE', $title);
     }
     
     /**
      * Places definitions for a placeholder within an existing page element for later retrievel
      *  
      * @param string $field
      * @param string $value           
      * @access protected   
      */
     protected function setDisplayVariables($field, $value){
        $this->pageElements[$field] = $value;
     }
     
     /**
      * Adds a javascript import string to the list of javascript import strings
      * 
      * @param string $jsSource
      * @access protected   
      */
     protected function addJS($jsSource){
       $this->pageElements['JS'][] = (substr_count($jsSource, 'http://') > 0) ? $jsSource : $this->config->dir('js') . '/' . $jsSource;
     }

     /**
      * Adds a css import string to the list of css import strings
      * 
      * @param string $cssSource
      * @access protected   
      */
     protected function addCSS($cssSource){
       $this->pageElements['CSS'][] = (substr_count($cssSource, 'http://') > 0) ? $cssSource : $this->config->dir('css') . '/' . $cssSource;
     }
     
     /**
      * Assembles all the page elements and displays the string result in the browser
      * 
      * @access public   
      */
     public function show(){
        // parse the template
        $page = $this->twig->loadTemplate($this->template);
        $page->display($this->pageElements);
     } 
  }
?>