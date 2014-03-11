<?php
  namespace Application\_frontend\_clients\_pages\login;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\UsersCollection as UsersCollection;
  use Framework\_engine\_core\Encryption as Encryption;
  
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
      $this->pageRequests = Register::getInstance()->get('pageRequests');
      $this->db = Register::getInstance()->get('db');
      $this->uri = Register::getInstance()->get('uri');
      $this->source = "client-templates";
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend',
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
      $form = foo(new FormGenerator(null, $this->config->dir($this->source).'/login/login_form.json'))->getFormHTML();
      $this->setDisplayVariables('LOGIN_FORM', $form);
    }

    /**
     * Processes the client login form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processLogin($params){
      $userCount = foo(new UsersCollection())->getLoginCount($params['values']['email'], $params['values']['type']);
      if($userCount != 1){
        echo 'restricted';
      } else {
        $userInfo = foo(new UsersCollection())->getByQuery('email = '.$this->db->quote($params['values']['email']));
        $user = array_shift($userInfo);
        $decryptedPassword = $this->pass_enc->decrypt(base64_decode($user['password']), $this->config->passwords['login']);
        if($decryptedPassword == $params['values']['password']){
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "CLIENT";
          $_SESSION[$this->config->sessionID]['USER_INFO'] = $user;
          $clientInfo = foo(new ClientsCollection())->getByQuery('email = '.$this->db->quote($params['values']['email']));
          $client = array_shift($clientInfo);
          $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $client;
          echo 'pass';  
        } else {
          echo 'restricted';
        }
      }
    }
  }
?>