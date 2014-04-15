<?php
  namespace Application\_frontend\_clients\_pages\orders;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Email as Email;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
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
      $this->addJS('_clients/orders/scripts.js');
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
      $orderForm = foo(new FormGenerator($this->config->dir($this->source).'/orders/order_form.json'))->getFormHTML();
      $this->setDisplayVariables('ORDER_FORM', $orderForm);
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      $params['doc']['_id'] = '';
      $params['doc']['collection'] = "feedback";
      $params['doc']['values']['description'] = '<p>'.$params['doc']['values']['description'].'</p>';
      $params['doc']['values']['client_id'] = $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'];
      $params['doc']['values']['date'] = date("m-d-Y H:i:s");
      $params['doc']['values']['read'] = 0;
      $params['doc']['values']['type'] = 'order';
      parent::saveEntry($params);
      //$to = ($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'] != "") ? $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'] : $_SESSION[$this->config->sessionID]['CLIENT_INFO']['company'];
      //$to .= '<'.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['email'].'>';
      $to = array('email' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['email'], 'name' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name']);
      $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $reply = array('email' => 'info@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $subject = 'Thank you for your new order!';
      $message = array('body' => 'Your order has been sent to be reviewed. A representative will contact you shortly.', 'altbody' => 'Your order has been sent to be reviewed. A representative will contact you shortly.');
      foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();
    }
  }
?>