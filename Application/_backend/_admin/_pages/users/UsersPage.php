<?php
  namespace Application\_backend\_admin\_pages\users;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
  /**
   * Class: UsersPage
   *    
   * Handles the Users Page
   */
  class UsersPage extends Backend{

    /**
     * Construct a new UsersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      $this->pass_enc = new Encryption(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
      parent::__construct();
    }
    
    /**
     * Initialize UsersPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/users/scripts.min.js');
      $this->setTitle('CEM Dashboard - User Management');
      $this->setTemplate('users/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('users');
      $select_users = $this->mongodb->getDocuments(array(),array("fullname" => 1));
      $this->setDisplayVariables('SELECT_USERS', $select_users);
      $userForm = foo(new FormGenerator(null, $this->config->dir($this->source).'/users/user_form.json'))->getFormHTML();
      $this->setDisplayVariables('USER_FORM', $userForm);
      $this->mongodb->switchCollection('clients');
      $nonuser_clients = $this->mongodb->getDocuments(array("is_user" => 0),array("company" => 1, "client_name" => 1));
      $this->setDisplayVariables('NONUSER_CLIENTS', $nonuser_clients);
    }

    /**
     * Reloads the user select and client list elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'users_select_container'){
        $this->mongodb->switchCollection('users');
        $select_users = $this->mongodb->getDocuments(array(),array("fullname" => 1));
        echo $this->twig->render('users/users_select.html', array('SELECT_USERS' => $select_users));
      } else if($params['dom_id'] == 'client-list'){
        $this->mongodb->switchCollection('clients');
        $nonuser_clients = $this->mongodb->getDocuments(array("is_user" => 0),array("company" => 1, "client_name" => 1));
        echo $this->twig->render('users/list-group-item.html', array('NONUSER_CLIENTS' => $nonuser_clients));
      }
    }

    /**
     * Gets the doc by _id
     * 
     * @param mixed array $params       
     * @access public
     */
    public function getEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['collection']))->getDocByID($params['_id'], $params['mongoid']);
        $results['password'] = $this->pass_enc->decrypt(base64_decode($results['password']), $this->config->passwords['login']);
        echo json_encode($results);
      }
    }

    /**
     * Saves a users form to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      if($this->isAdminUser()){
        $params['doc']['values']['password'] = base64_encode($this->pass_enc->encrypt($params['doc']['values']['password'], $this->config->passwords['login']));
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->saveDocEntry($params['doc']['values'], $params['doc']['_id']);
        if(($clientCount = $this->mongodb->getCount(array('_id' => $params['doc']['_id']))) == 1){
          $client = $this->mongodb->getDocument(array('_id' => $params['doc']['_id']));
          $client['is_user'] = 1;
          foo(new MongoAccessLayer('clients'))->saveDocEntry($client, $params['doc']['_id']);
        }
        echo json_encode($results);
      }
    }

    /**
     * Deletes a doc from the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function deleteEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->deleteDocEntry($params['doc']['_id'], $params['doc']['mongoid']);
        if(($clientCount = $this->mongodb->getCount(array('_id' => $params['doc']['_id']))) == 1){
          $client = $this->mongodb->getDocument(array('_id' => $params['doc']['_id']));
          $client['is_user'] = 0;
          foo(new MongoAccessLayer('clients'))->saveDocEntry($client, $params['doc']['_id']);
        }
        echo json_encode($results);
      }
    }
  }
?>