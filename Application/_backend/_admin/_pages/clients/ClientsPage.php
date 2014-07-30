<?php
  namespace Application\_backend\_admin\_pages\clients;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
  /**
   * Class: ClientsPage
   *    
   * Handles the Client Page
   */
  class ClientsPage extends Backend{

    /**
     * Client Select Pipeline - this is an aggregation pipeline of values that are needed for the client select drop down
     * 
     * mixed array
     * @access private
     */
    private $client_select_pipeline = array();

    /**
     * Construct a new ClientsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
      $this->client_select_pipeline = array(
        $this->mongoGen->projectStage(array("company" => 1, "client_name" => 1)),
        $this->mongoGen->sortStage(array("client_name" => 1, 'company' => 1))
      );
    }
    
    /**
     * Initialize ClientsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/clients/scripts.min.js');
      $this->setTitle('CEM Dashboard - Client Management');
      $this->setTemplate('clients/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('clients');
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients['result']);
      $clientForm = foo(new FormGenerator($this->config->dir($this->source).'/clients/clients_form.json'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm);
    }

    /**
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'clients_select_container'){
        $this->mongodb->switchCollection('clients');
        $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
        echo $this->twig->render('clients/clients_select.html', array('SELECT_CLIENTS' => $select_clients['result']));
      } else if($params['dom_id'] == 'project-tag-list' && $params['_id'] != 0){
        $this->mongodb->switchCollection('clients');
        $result = $this->mongodb->getDocument(array("_id" => new \MongoId($params['_id'])),array("_id" => 0, "project_tags" => 1));
        echo $this->twig->render('clients/list-group-item.html', array('PROJECT_TAGS' => $result['project_tags']));
      } 
    }

    /**
     * Saves a doc to the database
     *
     * @access public
     */
    public function saveEntry($params){
      $duplicate = false;
      if($params['doc']['_id'] == ''){
        $params['doc']['values']['is_user'] = 0;
        $this->mongodb->switchCollection('clients');
        $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
        $clientCount = $this->mongodb->getCount(array('email' => $regexEmail));
        if($clientCount > 0){
          $duplicate = true;
        }
      } else {
        $this->mongodb->switchCollection('clients');
        $client = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
        $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
        $clientCount = $this->mongodb->getCount(array('email' => $regexEmail));
        if($clientCount > 0 && strtolower($params['doc']['values']['email']) != strtolower($client['email'])){
          $duplicate = true;
        }
      }
      if(!$duplicate){
        parent::saveEntry($params);  
      } else {
        echo json_encode(array('err' => 'This email already exists. Please use a different email.'));
      }
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      $params['doc']['values'] = strtoupper($params['doc']['values']);
      parent::addSetToEntry($params);
    }
  }
?>