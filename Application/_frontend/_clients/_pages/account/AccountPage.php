<?php
  namespace Application\_frontend\_clients\_pages\account;
  use Application\_frontend\Frontend as Frontend;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: AccountPage
   *    
   * Handles the Account Page
   */
  class AccountPage extends Frontend{
    /**
     * Construct a new AccountPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "client-templates";
      parent::__construct();
    }
    
    /**
     * Initialize AccountPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_common/jquery-ui.css');
      $this->addJS('_common/jquery-ui.js');
      $this->addJS('_clients/account/scripts.min.js');
      $this->setTitle('CEM Dashboard - Edit Account');
      $this->setTemplate('account/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $clientForm = foo(new Form('clients'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm);
      $this->setDisplayVariables('CLIENT_ID', $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id']);
      $this->setDisplayVariables('CLIENT_RATE', number_format($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_rate'], 2, '.', ','));
    }
  }
?>