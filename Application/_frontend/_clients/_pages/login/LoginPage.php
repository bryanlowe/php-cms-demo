<?php
  namespace Application\_frontend\_clients\_pages\login;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  
  /**
   * Class: LoginPage
   *    
   * Handles the Login Page
   */
  class LoginPage extends Frontend{

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
      $this->source = "client-templates";
      $this->siteCache = "/_clients";
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend/'.$this->siteCache,
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
      $this->addJS('_clients/login/scripts.min.js');
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
      $form = foo(new FormGenerator($this->config->dir($this->source).'/login/login_form.json'))->getFormHTML();
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
      $regexEmail = new \MongoRegex("/^".$params['values']['email']."$/i"); 
      $userCount = $this->mongodb->getCount(array('email' => $regexEmail, 'type' => 'CLIENT'));
      if($userCount != 1){
        echo 'restricted';
      } else {
        $userInfo = $this->mongodb->getDocument(array('email' => $regexEmail));
        $decryptedPassword = $this->pass_enc->decrypt(base64_decode($userInfo['password']), $this->config->passwords['login']);
        if($decryptedPassword == $params['values']['password']){
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "CLIENT";
          $_SESSION[$this->config->sessionID]['USER_INFO'] = $userInfo;
          $clientInfo = foo(new MongoAccessLayer('users'))->joinCollectionsByID(array($userInfo), 'clients', '_id');
          $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $clientInfo[0]['clients'];
          echo 'pass';  
        } else {
          echo 'restricted';
        }
      }
    }
  }
?>