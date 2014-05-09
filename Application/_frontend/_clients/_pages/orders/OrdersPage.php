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
      $tagOpts = array('project_tags' => array('value' => '', 'options' => $this->gatherTagOptions()));
      $orderForm = foo(new FormGenerator($this->config->dir($this->source).'/orders/order_form.json', $tagOpts))->getFormHTML();
      $this->setDisplayVariables('ORDER_FORM', $orderForm);
    }

    /**
     * Gathers project tags from the client
     *
     * @access private
     * @return string array options
     */
    private function gatherTagOptions(){
      $options = array();
      $tags = $_SESSION[$this->config->sessionID]['CLIENT_INFO']['project_tags'];
      $maxTags = count($tags);
      for($i = 0; $i < $maxTags; $i++){
        $options[] = array('name' => $tags[$i], 'value' => $tags[$i]); 
      }
      return $options;
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
      $params['doc']['values']['description'] = $params['doc']['values']['description'];
      $params['doc']['values']['client_id'] = $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'];
      $params['doc']['values']['date'] = date("U");
      $params['doc']['values']['read'] = 0;
      $params['doc']['values']['type'] = 'order';
      parent::saveEntry($params);
      $to = array('email' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['email'], 'name' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name']);
      $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $reply = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $subject = 'Thank you for your new order!';
      $message = array('body' => 'Your order has been sent to be reviewed. A representative will contact you shortly.', 'altbody' => 'Your order has been sent to be reviewed. A representative will contact you shortly.');
      foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();

      $cem_to = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $cem_from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $cem_reply = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $cem_subject = 'New Order Submission From: '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].', Date: '.$params['doc']['values']['date'];
      $messageBody = '<p>You have recieved a new order from '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].'.</p><p>Please <a href="https://dashboard.contentequalsmoney.com/admin" target="_blank">login</a> for more details.</p>';
      $cem_message = array('body' => $messageBody, 'altbody' => $messageBody);
      foo(new Email($cem_to, $cem_from, $cem_reply, $cem_subject, $cem_message, $this->config->smtpInfo))->sendEmail();
    }
  }
?>