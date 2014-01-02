<?php
  namespace Framework\_engine\_core;
  
  /**
   * Class: Page
   *    
   * Abstract class that defines the page rendering functions of the site
   */ 
  abstract class Page{
     /**
      * The array of the current pages javascript imports
      * 
      * @var    jsList
      * @access protected            
      */
     protected $jsList = array();

     /**
      * The array of the current pages css stylesheet imports
      * 
      * @var    cssList
      * @access protected            
      */
     protected $cssList = array();

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
      * Sets up the document header module
      *              
      * @access protected   
      */
     protected function docHeader(){
        $this->setDocHeader();
        $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'DOCHEADER');
     }

     /**
      * Sets up the site header module
      *              
      * @access protected   
      */
     protected function header(){
        $this->setHeader();
        $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'HEADER');
     }

     /**
      * Sets up the site body module
      *              
      * @access protected   
      */
     protected function body(){
        $this->setBody();
        $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
     }

     /**
      * Sets up the site footer module
      *              
      * @access protected   
      */
     protected function footer(){
        $this->setFooter();
        $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'FOOTER');
        $this->setDisplayVariables('YEAR', date('Y'), 'FOOTER');
     }
     
     /**
      * Gathers all the javascript and css imports and places them in the document header, 
      * Outputs the document header and the body. Outputs the site header and footer if they exist.
      *              
      * @access protected   
      */
     protected function assemblePage(){
        $jsString = null;
        $cssString = null;
        
        foreach($this->jsList as $js){
          $jsString .= '<script type="text/javascript" src="'.$js.'"></script>';
        }
        
        foreach($this->cssList as $css){
          $cssString .= '<link type="text/css" href="'.$css.'" rel="stylesheet" />';
        }
        
        $this->setDisplayVariables('JS', $jsString, 'FOOTER');
        $this->setDisplayVariables('CSS', $cssString, 'DOCHEADER');
        $this->outputVariablesToDisplay($this->pageElements, 'DOCHEADER');
        $this->outputVariablesToDisplay($this->pageElements, 'BODY');
        if(count($this->pageElements['HEADER'])){$this->outputVariablesToDisplay($this->pageElements, 'HEADER');}
        if(count($this->pageElements['FOOTER'])){$this->outputVariablesToDisplay($this->pageElements, 'FOOTER');}
     }
     
     /**
      * Retrieves the document header module template
      *              
      * @param $template
      * @access protected   
      */
     protected function setDocHeader($template = null){}
     
     /**
      * Retrieves the site header module template
      *              
      * @param string $template
      * @access protected   
      */
     protected function setHeader($template = null){}
     
     /**
      * Retrieves the site footer module template
      *              
      * @param string $template
      * @access protected   
      */
     protected function setFooter($template = null){}
     
     /**
      * Retrieves the site body module template
      *              
      * @param string $template
      * @access protected   
      */
     protected function setBody($template = null){}
     
     /**
      * Retrieves any generic site template other than docheader, header, footer and body
      *  
      * @param string $template
      * @param string $source            
      * @access protected   
      */
     protected function setTemplate($template, $source){
       $template = file_get_contents($this->config->dir($source) . '/' . $template);
       return str_replace('<!--///IMAGEPATH///-->', $this->config->dir('images'), $template);
     }
     
     /**
      * Sets up the Title tag for the site
      *      
      * @param string $title
      * @access protected   
      */
     protected function setTitle($title){
        $this->setDisplayVariables('TITLE', $title, 'DOCHEADER');
     }
     
     /**
      * Places definitions for a placeholder within an existing page element for later retrievel
      *  
      * @param string $field
      * @param string $value
      * @param string $source            
      * @access protected   
      */
     protected function setDisplayVariables($field, $value, $source){
        if(array_key_exists($source, $this->pageElements)){
          $this->pageElements[$source][$field] = $value;
        }
     }
     
     /**
      * Creates an array library of display placeholders and their definitions
      * 
      * @return array $displayVars
      * @param array $variables
      * @access protected   
      */
     protected function createDisplayVariables($variables){
        $displayVars = array();
        foreach((array)$variables as $key => $value){
          $displayVars['<!--///'.$key.'///-->'] = $value;
        }
        return $displayVars;
     }
     
     /**
      * Looks up placeholder definitions and places them in the page element source string
      * 
      * @param array $fields
      * @param string $section
      * @access protected   
      */
     protected function outputVariablesToDisplay($fields, $section){
        foreach($fields[$section] as $key => $value){
          if($value != 'SOURCE'){
            $this->pageElements[$section]['SOURCE'] = str_replace('<!--///'.$key.'///-->', $value, $this->pageElements[$section]['SOURCE']);
          }
        }
     }
     
     /**
      * Adds a javascript import string to the list of javascript import strings
      * 
      * @param string $jsSource
      * @access protected   
      */
     protected function addJS($jsSource){
       $this->jsList[] = (substr_count($jsSource, 'http://') > 0) ? $jsSource : $this->config->dir('js') . '/' . $jsSource;
     }

     /**
      * Adds a css import string to the list of css import strings
      * 
      * @param string $cssSource
      * @access protected   
      */
     protected function addCSS($cssSource){
       $this->cssList[] = (substr_count($cssSource, 'http://') > 0) ? $cssSource : $this->config->dir('css') . '/' . $cssSource;
     }
     
     /**
      * Assembles all the page elements and displays the string result in the browser
      * 
      * @access public   
      */
     public function show(){
        $this->assemblePage();
        echo $this->pageElements['DOCHEADER']['SOURCE'].$this->pageElements['HEADER']['SOURCE'].$this->pageElements['BODY']['SOURCE'].$this->pageElements['FOOTER']['SOURCE'];
     } 
  }
?>