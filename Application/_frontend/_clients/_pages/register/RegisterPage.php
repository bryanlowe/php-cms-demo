<?php
  namespace Application\_frontend\_clients\_pages\register;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_core\Email as Email;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  
  /**
   * Class: RegisterPage
   *    
   * Handles the Register Page
   */
  class RegisterPage extends Frontend{

    /**
     * Encryption class object
     *
     * @access protected
     */
    protected $pass_enc = null;

    /**
     * Construct a new RegisterPage object
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
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize RegisterPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_clients/register/scripts.min.js');
      $this->setTitle('CEM Dashboard - Register');
      $this->setTemplate('register/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $form = foo(new FormGenerator($this->config->dir($this->source).'/register/register_form.json'))->getFormHTML();
      $this->setDisplayVariables('REGISTER_FORM', $form);
    }

    /**
     * Saves a doc to the database
     *
     * @access public
     */
    public function saveEntry($params){
      $this->mongodb->switchCollection('clients');
      $emailCount = $this->mongodb->getCount(array('email' => $params['doc']['values']['email']));
      if($emailCount > 0){
        echo "This email is already registered. If you forgot your password please click <a href='/forgot-password'>here</a>.";
      } else {
        $newClient = array(
          'client_name' => $params['doc']['values']['client_name'],
          'email' => $params['doc']['values']['email'],
          'company' => $params['doc']['values']['company'],
          'phone_number' => $params['doc']['values']['phone_number'],
          'address' => $params['doc']['values']['address'],
          'city' => $params['doc']['values']['city'],
          'zip' => $params['doc']['values']['zip'],
          'state' => $params['doc']['values']['state'],
          'is_user' => 1
        );
        $result = foo(new MongoAccessLayer('clients'))->saveDocEntry($newClient); 
        if($result['err'] == null){
          $this->mongodb->switchCollection('clients');
          $client = $this->mongodb->getDocument(array('email' => $params['doc']['values']['email']));
          $user = array(
            'fullname' => $client['client_name'],
            'password' => base64_encode($this->pass_enc->encrypt($params['doc']['values']['password'], $this->config->passwords['login'])),
            'email' => $client['email'],
            'type' => 'CLIENT',
            'status' => 1,
          );
          foo(new MongoAccessLayer('users'))->saveDocEntry($user, (string)$client['_id']);
          $to = array('email' => $client['email'], 'name' => $client['client_name']);
          $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
          $reply = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
          $subject = 'Thank you for registering!';
          $message = array('body' => 'Thank you for joining!', 'altbody' => 'Thank you for joining!');
          foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();

          $cem_to = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
          $cem_from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
          $cem_reply = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
          $cem_subject = 'A new client has signed up!';
          $messageBody = '<p>A new client has signed up via the dashboard!</p><p>Name: '.$client['client_name'].'<br />Company: '.$client['company'].'<br />Email: '.$client['email'].'</p>';
          $cem_message = array('body' => $messageBody, 'altbody' => $messageBody);
          foo(new Email($cem_to, $cem_from, $cem_reply, $cem_subject, $cem_message, $this->config->smtpInfo))->sendEmail();
          
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = "CLIENT";
          $_SESSION[$this->config->sessionID]['USER_INFO'] = $user;
          $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $client;
          echo 'pass';
        } else {
          echo $result['err'];
        }
      }
        
    }
  }
?>