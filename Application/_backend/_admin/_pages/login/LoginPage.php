<?php
  namespace Application\_Backend\_admin\_pages\login;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_core\Encryption as Encryption;
  
  /**
   * Class: LoginPage
   *    
   * Handles the Login Page
   */
  class LoginPage extends Backend{

    /**
     * Encryption class object
     *
     * @access protected
     */
    protected $pass_enc = null;

    /**
     * Construct a new LoginPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');
      $this->mongodb = Register::getInstance()->get('mongodb');
      $this->source = "admin-templates";
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_backend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize LoginPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/login/scripts.min.js');
      $this->setTitle('CEM Dashboard - Log In');
      $this->setTemplate('login/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $form = foo(new FormGenerator(null, $this->config->dir($this->source).'/login/login_form.json'))->getFormHTML();
      $this->setDisplayVariables('LOGIN_FORM', $form);
    }   

    /**
     * Processes the admin login form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processLogin($params){
      $this->mongodb->switchCollection('users');
      $userCount = $this->mongodb->getCount(array('email' => $params['values']['email']));
      if($userCount != 1){
        echo 'restricted';
      } else {
        $userInfo = $this->mongodb->getDocument(array('email' => $params['values']['email']));
        $decryptedPassword = $this->pass_enc->decrypt(base64_decode($userInfo['password']), $this->config->passwords['login']);
        if($decryptedPassword == $params['values']['password']){
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "ADMIN";
          $_SESSION[$this->config->sessionID]['USER_INFO'] = $userInfo;
          echo 'pass';  
        } else {
          echo 'restricted';
        }
      }
    }
  }
?>