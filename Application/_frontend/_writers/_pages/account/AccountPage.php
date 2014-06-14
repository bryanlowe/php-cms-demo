<?php
  namespace Application\_frontend\_clients\_pages\account;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Encryption as Encryption;
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
      $clientInfo = $_SESSION[$this->config->sessionID]['CLIENT_INFO'];
      $clientInfo['_id'] = (string) $clientInfo['_id'];
      $clientInfo['password'] = $this->pass_enc->decrypt(base64_decode($_SESSION[$this->config->sessionID]['USER_INFO']['password']), $this->config->passwords['login']);
      $clientForm = foo(new FormGenerator($this->config->dir($this->source).'/account/clients_form.json', $clientInfo))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm);
      $this->setDisplayVariables('CLIENT_RATE', number_format($clientInfo['client_rate'], 2, '.', ','));
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      $client = array(
        'client_name' => $params['doc']['values']['client_name'],
        'email' => $params['doc']['values']['email'],
        'company' => $params['doc']['values']['company'],
        'phone_number' => $params['doc']['values']['phone_number'],
        'address' => $params['doc']['values']['address'],
        'city' => $params['doc']['values']['city'],
        'zip' => $params['doc']['values']['zip'],
        'state' => $params['doc']['values']['state'],
      );
      $user = array(
        'password' => base64_encode($this->pass_enc->encrypt($params['doc']['values']['password'], $this->config->passwords['login']))
      );
      foo(new MongoAccessLayer('users'))->saveDocEntry($user, $params['doc']['_id']);
      $result = foo(new MongoAccessLayer('clients'))->saveDocEntry($client, $params['doc']['_id']);
      echo json_encode($result);
      $this->mongodb->switchCollection('clients');
      $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
    }
  }
?>