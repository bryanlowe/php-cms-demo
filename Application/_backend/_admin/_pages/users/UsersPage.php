<?php
  namespace Application\_backend\_admin\_pages\users;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: UserManagementPage
   *    
   * Handles the User Management Page
   */
  class UsersPage extends Backend{

    /**
     * Construct a new UserManagementPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize UserManagementPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - User Settings');
    }

    /**
     * Set UserManagementPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set UserManagementPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('users/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $userForm = foo(new Form('users'))->getFormHTML();
      $this->setDisplayVariables('USER_FORM', $userForm, 'BODY');
    }

    /**
     * Set UserManagementPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('admin-templates') . '/users/scripts.html');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'FOOTER');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    } 

    /**
     * Gather BLL Resources from the database
     *
     * @param assoc array $param
     * @param int priKey
     * @access public
     */
    public function gatherBLLResource($params){
      if($this->isAdminUser()){
        $where = "";
        if($params['bllAction'] == "SELECTION"){
          $tblInfo = foo(new Selection($params['table']))->getByID($params['primaryKey'])->getValues();
          if($params['table'] == 'users'){
            $tblInfo['password'] = $this->pass_enc->decrypt(base64_decode($tblInfo['password']), $this->config->loginKey);
          }
          echo json_encode(array($tblInfo));  
        } else {
          echo json_encode(foo(new Collection($params['table']))->getAll(null, null, null, $params['order']));  
        }
      }    
    }   
  }
?>