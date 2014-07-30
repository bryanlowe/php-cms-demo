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
  class UsersPage extends Backend {

    /**
     * User Select Pipeline - this is an aggregation pipeline of values that are needed for the user select drop down
     * 
     * mixed array
     * @access private
     */
    private $user_select_pipeline = array();

    /**
     * Construct a new UsersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      $this->pass_enc = new Encryption(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
      parent::__construct();
      $this->user_select_pipeline = array(
        $this->mongoGen->projectStage(array("fullname" => 1)),
        $this->mongoGen->sortStage(array("fullname" => 1))
      );
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
      $select_users = $this->mongodb->aggregateDocs($this->user_select_pipeline);
      $this->setDisplayVariables('SELECT_USERS', $select_users['result']);
      $userForm = foo(new FormGenerator($this->config->dir($this->source).'/users/user_form.json'))->getFormHTML();
      $this->setDisplayVariables('USER_FORM', $userForm);
      $this->mongodb->switchCollection('clients');
      $nonuser_clients = $this->mongodb->getDocuments(array("is_user" => 0),array("company" => 1, "client_name" => 1));
      $this->setDisplayVariables('NONUSER_CLIENTS', $nonuser_clients);
      $this->mongodb->switchCollection('writers');
      $nonuser_writers = $this->mongodb->getDocuments(array("is_user" => 0),array("writer_name" => 1));
      $this->setDisplayVariables('NONUSER_WRITERS', $nonuser_writers);
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
      } else if($params['dom_id'] == 'client-writer-list'){
        $this->mongodb->switchCollection('clients');
        $nonuser_clients = $this->mongodb->getDocuments(array("is_user" => 0),array("company" => 1, "client_name" => 1));
        $this->mongodb->switchCollection('writers');
        $nonuser_writers = $this->mongodb->getDocuments(array("is_user" => 0),array("writer_name" => 1));
        echo $this->twig->render('users/list-group-item.html', array('NONUSER_CLIENTS' => $nonuser_clients, 'NONUSER_WRITERS' => $nonuser_writers));
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
        if($results['password'] != ''){
          $results['password'] = $this->pass_enc->decrypt(base64_decode($results['password']), $this->config->passwords['login']);
        }
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
        $duplicate = false;
        if($params['doc']['values']['password'] != ''){
          $params['doc']['values']['password'] = base64_encode($this->pass_enc->encrypt($params['doc']['values']['password'], $this->config->passwords['login']));
        }

        // catch duplicate entries. If there is a duplicate, send an error for new user logins
        if($params['doc']['_id'] == ""){
          $this->mongodb->switchCollection('users');
          $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
          $userCount = $this->mongodb->getCount(array('email' => $regexEmail));
          if($userCount > 0){
            $duplicate = true;
          }
        }
        // catch duplicate entries. If there is a duplicate, send an error for new user logins
        if(!$duplicate){
          $results = foo(new MongoAccessLayer($params['doc']['collection']))->saveDocEntry($params['doc']['values'], $params['doc']['_id']);
          $this->mongodb->switchCollection('clients');
          if(($clientCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
            $client = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])), array('_id' => 0));
            $client['is_user'] = 1;
            foo(new MongoAccessLayer('clients'))->saveDocEntry($client, $params['doc']['_id']);
          }
          $this->mongodb->switchCollection('writers');
          if(($writerCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
            $writer = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])), array('_id' => 0));
            $writer['is_user'] = 1;
            $writer['writer_type'] = $params['doc']['values']['type'];
            foo(new MongoAccessLayer('writers'))->saveDocEntry($writer, $params['doc']['_id']);
          }
        } else {
          $results = array('err' => 'This email already exists. Please use a different email.');
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
        $this->mongodb->switchCollection('clients');
        if(($clientCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
          $client = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])), array('_id' => 0));
          $client['is_user'] = 0;
          foo(new MongoAccessLayer('clients'))->saveDocEntry($client, $params['doc']['_id']);
        }
        $this->mongodb->switchCollection('writers');
        if(($writerCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
          $writer = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])), array('_id' => 0));
          $writer['is_user'] = 0;
          foo(new MongoAccessLayer('writers'))->saveDocEntry($writer, $params['doc']['_id']);
        }
        echo json_encode($results);
      }
    }
  }
?>