<?php
  namespace Application\_backend\_admin\_pages\resourcemanagement;
  use Application\_backend\Backend as Backend;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: ResourceManagementPage
   *    
   * Handles the Resource Management Page
   */
  class ResourceManagementPage extends Backend{

    /**
     * Construct a new ResourceManagementPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize ResourceManagementPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('EvTools CMS - Resource Settings');
    }

    /**
     * Set ResourceManagementPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set ResourceManagementPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('resourcemanagement/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $clientForm = foo(new Form('clients'))->getFormHTML();
      $clientAccessForm = foo(new Form('clientaccess'))->getFormHTML();
      $webserverForm = foo(new Form('webservers'))->getFormHTML();
      $webserverAccessForm = foo(new Form('webserveraccess'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm, 'BODY');
      $this->setDisplayVariables('CLIENT_ACCESS_FORM', $clientAccessForm, 'BODY');
      $this->setDisplayVariables('WEBSERVER_FORM', $webserverForm, 'BODY');
      $this->setDisplayVariables('WEBSERVER_ACCESS_FORM', $webserverAccessForm, 'BODY');
    } 

    /**
     * Set ResourceManagementPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('backend-templates') . '/resourcemanagement/scripts.html');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }   
  }
?>