<?php
  namespace Application\_Backend\_admin\_pages\login;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_core\Encryption as Encryption;
  use Application\_tools\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Application\_engine\_bll\_collection\UsersCollection as UsersCollection;
  
  /**
   * Class: LoginPage
   *    
   * Handles the Login Page
   */
  class LoginPage extends Backend{

    /**
     * Encryption class object
     *
     * @access private
     */
    private $pass_enc = null;

    /**
     * Construct a new LoginPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');
      $this->pageRequests = Register::getInstance()->get('pageRequests');
      $this->db = Register::getInstance()->get('db');
      $this->uri = Register::getInstance()->get('uri');
      $this->source = "admin-templates";
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
    }
    
    /**
     * Initialize LoginPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Log In');
    }

    /**
     * Set LoginPage header
     *    
     * @access protected
     */
    protected function header(){
      $this->setHeader("login/header.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'HEADER');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'HEADER');
    }
    
    /**
     * Set LoginPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('login/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $form = foo(new FormGenerator(null, $this->config->dir('admin-templates').'/login/login_form.json'))->getFormHTML();
      $this->setDisplayVariables('LOGIN_FORM', $form, 'BODY');
    }   

    /**
     * Processes the admin login form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processLogin($params){
      $userCount = foo(new UsersCollection())->getLoginCount($params['values']['email'], $params['values']['password'], $params['values']['type']);
      if($userCount != 1){
          echo 'restricted';
      } else {
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "ADMIN";
          $userInfo = foo(new UsersCollection())->getByQuery('email = '.$this->db->quote($params['values']['email']).' AND password = '.$this->db->quote($params['values']['password']));
          $_SESSION[$this->config->sessionID]['USER_INFO'] = array_shift($userInfo);
          echo 'pass';
      }
    }
  }
?>