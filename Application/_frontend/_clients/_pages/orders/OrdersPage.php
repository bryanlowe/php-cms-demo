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
      parent::__construct();
      $this->source = "client-templates";
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
    }
    
    /**
     * Set OrdersPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('orders/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $orderForm = foo(new Form('orders'))->getFormHTML();
      $this->setDisplayVariables('ORDER_FORM', $orderForm, 'BODY');
      $this->setDisplayVariables('CLIENT_ID', $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id'], 'BODY');
    }
  }
?>