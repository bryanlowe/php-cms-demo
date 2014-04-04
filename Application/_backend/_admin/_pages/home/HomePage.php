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
      $this->setTitle('CEM Dashboard - Admin');
      $this->setTemplate('home/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('feedback');
      $post_count = $this->mongodb->getCount(array('read' => 0, 'type' => 'testimonial'));
      $order_count = $this->mongodb->getCount(array('read' => 0, 'type' => 'order'));
      $this->setDisplayVariables('POST_COUNT', $post_count);
      $this->setDisplayVariables('ORDER_COUNT', $order_count);
    }
  }
?>