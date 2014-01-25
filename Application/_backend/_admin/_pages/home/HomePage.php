<?php
  namespace Application\_backend\_admin\_pages\home;
  use Application\_backend\Backend as Backend;
  
  /**
   * Class: HomePage
   *    
   * Handles the Home Page
   */
  class HomePage extends Backend{

    /**
     * Construct a new HomePage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize HomePage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/home/scripts.min.js');
      $this->setTitle('CEM Dashboard - Admin');
    }

    
    /**
     * Set HomePage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('home/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'BODY');
    }    
  }
?>