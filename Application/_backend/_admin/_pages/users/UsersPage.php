<?php
  namespace Application\_backend\_admin\_pages\users;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
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
      parent::__construct();
      $this->source = "admin-templates";
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
    }

    /**
     * Set UsersPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('users/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $userForm = foo(new Form('users'))->getFormHTML();
      $this->setDisplayVariables('USER_FORM', $userForm, 'BODY');
      $clientForm = foo(new FormGenerator(null, $this->config->dir('admin-templates').'/users/client_form.json'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm, 'BODY');
    }   
  }
?>