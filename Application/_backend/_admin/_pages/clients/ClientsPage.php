<?php
  namespace Application\_backend\_admin\_pages\clients;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
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
      parent::__construct();
      $this->source = "admin-templates";
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
    }

    /**
     * Set ClientsPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set ClientsPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('clients/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $clientForm = foo(new Form('clients'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm, 'BODY');
    }
  }
?>