<?php
  namespace Application\_backend\_admin\_pages\clients;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
  /**
   * Class: ClientsPage
   *    
   * Handles the Customer Page
   */
  class ClientsPage extends Backend{

    /**
     * Construct a new ClientsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
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
      $select_clients = $this->mongodb->getDocuments(array(),array("company" => 1, "client_name" => 1));
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients);
      $clientForm = foo(new FormGenerator(null, $this->config->dir($this->source).'/clients/clients_form.json'))->getFormHTML();
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
        $select_clients = $this->mongodb->getDocuments(array(),array("company" => 1, "client_name" => 1));
        echo $this->twig->render('clients/clients_select.html', array('SELECT_CLIENTS' => $select_clients));
      } 
    }

    /**
     * Saves a doc to the database
     *
     * @access public
     */
    public function saveDocEntry($params){
      if($params['values']['_id'] == ''){
        $params['values']['is_user'] = 0;
      }
      parent::saveDocEntry($params);  
    }
  }
?>