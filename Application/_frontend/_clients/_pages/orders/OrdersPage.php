<?php
  namespace Application\_frontend\_clients\_pages\orders;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: OrdersPage
   *    
   * Handles the Order Page
   */
  class OrdersPage extends Frontend{

    /**
     * Construct a new OrdersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "client-templates";
      parent::__construct();
    }
    
    /**
     * Initialize OrdersPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_clients/orders/scripts.min.js');
      $this->setTitle('CEM Dashboard - Place An Order');
      $this->setTemplate('orders/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $orderForm = foo(new Form('orders'))->getFormHTML();
      $this->setDisplayVariables('ORDER_FORM', $orderForm);
      $this->setDisplayVariables('CLIENT_ID', $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id']);
    }
  }
?>