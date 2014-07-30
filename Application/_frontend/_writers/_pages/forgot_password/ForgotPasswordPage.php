<?php
  namespace Application\_frontend\_writers\_pages\forgot_password;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_core\Email as Email;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: ForgotPasswordPage
   *    
   * Handles the Forgot Password Page
   */
  class ForgotPasswordPage extends Frontend{

    /**
     * Encryption class object
     *
     * @access protected
     */
    protected $pass_enc = null;

    /**
     * Construct a new ForgotPasswordPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');
      $this->mongodb = Register::getInstance()->get('mongodb');
      $this->source = "writer-templates";
      $this->userType = "WRITER";
      $this->siteDir = "/writers/";
      $this->siteCache = "/_writers";
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      $this->mongoGen = new MongoGenerator();
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize ForgotPasswordPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_writers/forgot-password/scripts.min.js');
      $this->setTitle('CEM Writer Dashboard - Forgot Password');
      $this->setTemplate('forgot-password/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $form = foo(new FormGenerator($this->config->dir($this->source).'/forgot-password/fp_form.json'))->getFormHTML();
      $this->setDisplayVariables('FP_FORM', $form);
    }

    /**
     * Processes the forgot password form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processForgotPassword($params){
      $this->mongodb->switchCollection('users');
      $regexEmail = new \MongoRegex("/^".$params['email']."$/i"); 
      $query = $this->mongoGen->logicOp(array(array('email' => $regexEmail), $this->mongoGen->logicOp(array(array('type' => 'WRITER'),array('type' => 'EDITOR')),MongoGenerator::LOGICAL_OR)),MongoGenerator::LOGICAL_AND);
      $userCount = $this->mongodb->getCount($query);
      if($userCount != 1){
        echo 'Email not found in database.';
      } else {
        $userInfo = $this->mongodb->getDocument(array('email' => $regexEmail), array('email' => 1, 'fullname' => 1));
        $randomString = $this->generateRandomString();
        $password = array('password' => base64_encode($this->pass_enc->encrypt($randomString, $this->config->passwords['login'])));
        foo(new MongoAccessLayer('users'))->saveDocEntry($password, (string)$userInfo['_id']);

        $to = array('email' => $userInfo['email'], 'name' => $userInfo['fullname']);
        $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
        $reply = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
        $subject = 'Forgotten Password';
        $msg = '<p>Hello '.$userInfo['fullname'].', your new password is "'.$randomString.'". Please click <a href="https://dashboard.contentequalsmoney.com/writers/login">here</a> to login.</p>';
        $message = array('body' => $msg, 'altbody' => $msg);
        foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();
        echo 'pass';
      }
    }

    /**
     * Produces a randomized string
     *
     * @param int length - changes the length of the string
     * @return string
     * @access private
     */
    private function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
    }
  }
?>