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
      $this->source = "admin-templates";
      parent::__construct();
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
      $this->setTemplate('home/main.html');
    }
  }
?>