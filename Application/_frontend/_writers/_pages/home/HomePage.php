<?php
  namespace Application\_frontend\_writers\_pages\home;
  use Application\_frontend\Frontend as Frontend;
  
  /**
   * Class: HomePage
   *    
   * Handles the Login Page
   */
  class HomePage extends Frontend{

    /**
     * Construct a new HomePage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "writer-templates";
      $this->userType = "WRITER";
      $this->siteDir = "/writers/";
      parent::__construct();
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
    }
    
    /**
     * Initialize HomePage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Home');
    }

    /**
     * Set HomePage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set HomePage body
     *    
     * @access protected
     */
    public function body(){
      $this->setBody('home/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
    }
  }
?>
