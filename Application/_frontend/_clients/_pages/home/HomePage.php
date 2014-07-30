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
      $this->source = "client-templates";
      $this->siteCache = "/_clients";
      parent::__construct();
    }
    
    /**
     * Initialize HomePage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Home');
      $this->setTemplate('home/main.html');
    }
  }
?>
