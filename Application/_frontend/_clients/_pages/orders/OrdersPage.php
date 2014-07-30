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
      $this->siteCache = "/_clients";
      parent::__construct();
    }
    
    /**
     * Initialize OrdersPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_common/uploadifive.css');
      $this->addJS('_common/jquery.uploadifive.js');
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
      $time = date('U');
      $formVals = array(
        'project_tags' => array('value' => '', 'options' => $this->gatherTagOptions()),
        'timestamp' => array('value' => $time),
        'token' => array('value' => md5($this->config->passwords['uploads'] . $time)),
        'client_id' => array('value' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'])
      );
      $orderForm = foo(new FormGenerator($this->config->dir($this->source).'/orders/order_form.json', $formVals))->getFormHTML();
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

    /**
     * Notification to the admin email of new files that have been uploaded to the server
     *
     * @param mixed array params
     * @access public
     */
    public function sendUploadNotification($params){
      $fileList = 'The following files have been added to Client Resources for '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].':<br /><br />';
      $postfix = "_".$_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id']."_".date('m-d-Y');
      $maxFiles = count($params['filenames']);
      for($i = 0; $i < $maxFiles; $i++){
        $fileNameParts = explode('.', $params['filenames'][$i]);
        $fileNameParts[0] = $fileNameParts[0].$postfix;
        $fileList .= implode('.', $fileNameParts).'<br /><br />';
      }
      $fileList .= 'You may find these files by logging into the Admin Dashboard and navigating to the Client Resources page.<br />';
      $fileList .= 'Select "'.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['company'].' -- '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].'" in the client dropdown selection.';

      $to = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $reply = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $subject = 'Client - '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].' has provided new resources';
      $message = array('body' => $fileList, 'altbody' => $fileList);
      foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();
    }
  }
?>