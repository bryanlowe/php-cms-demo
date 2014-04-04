<?php
  namespace Application\_frontend\_clients\_pages\account;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
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
      $this->addJS('_clients/account/scripts.js');
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
      $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'] = (string) $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'];
      $clientForm = foo(new FormGenerator($this->config->dir($this->source).'/account/clients_form.json', $_SESSION[$this->config->sessionID]['CLIENT_INFO']))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm);
      $this->setDisplayVariables('CLIENT_RATE', number_format($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_rate'], 2, '.', ','));
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      parent::saveEntry($params);
      $this->mongodb->switchCollection('clients');
      $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
    }
  }
?>