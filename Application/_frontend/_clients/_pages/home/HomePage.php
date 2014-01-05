<?php
  namespace Application\_frontend\_clients\_pages\home;
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
      parent::__construct();
      $this->source = "client-templates";
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
