<?php
  namespace Application\_frontend\_clients\_pages\account;
  use Application\_frontend\Frontend as Frontend;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Framework\_engine\_dal\Selection as Selection;
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
      parent::__construct();
      $this->source = "client-templates";
    }
    
    /**
     * Initialize AccountPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_clients/account/scripts.min.js');
      $this->setTitle('CEM Dashboard - Edit Account');
    }

    /**
     * Set AccountPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set AccountPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('account/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $clientForm = foo(new Form('clients'))->getFormHTML();
      $client = foo(new ClientsCollection())->getByQuery('email = '.$this->db->quote($_SESSION[$this->config->sessionID]['USER_INFO']['email']));
      $client = array_shift($client);
      $this->setDisplayVariables('CLIENT_FORM', $clientForm, 'BODY');
      $this->setDisplayVariables('CLIENT_ID', $client['client_id'], 'BODY');
    }
  }
?>