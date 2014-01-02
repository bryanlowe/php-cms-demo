<?php
  namespace Application\_frontend\_pages\login;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Application\_tools\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Application\_engine\_bll\_collection\UsersCollection as UsersCollection;
  
  /**
   * Class: LoginPage
   *    
   * Handles the Login Page
   */
  class LoginPage extends Frontend{

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
    }
    
    /**
     * Initialize LoginPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('EvTools CMS - Log In');
    }

    /**
     * Set LoginPage header
     *    
     * @access protected
     */
    protected function header(){
      $this->setHeader("login/header.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'HEADER');
    }

    /**
     * Set LoginPage footer
     *    
     * @access protected
     */
    protected function footer(){
      $this->setFooter("login/footer.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'FOOTER');
    }
    
    /**
     * Set LoginPage body
     *    
     * @access protected
     */
    public function body(){
      $this->setBody('login/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $form = foo(new FormGenerator(null, $this->config->dir('frontend-templates').'/login/login_form.json'))->getFormHTML();
      $this->setDisplayVariables('LOGIN_FORM', $form, 'BODY');
    }

    /**
     * Processes the login form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processLogin($params){
      $userCount = foo(new UsersCollection())->getLoginCount(addslashes($params['values']['username']), addslashes($params['values']['password']), $params['values']['type']);
      if($userCount != 1){
          echo 'error';
      } else {
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "NORM";
          $userInfo = foo(new UsersCollection())->getByQuery('username = "'.addslashes($params['values']['username']).'" AND password = "'.md5(addslashes($params['values']['password'])).'"');
          $_SESSION[$this->config->sessionID]['USER_INFO'] = array_shift($userInfo);
          echo 'pass';
      }
    }
  }
?>