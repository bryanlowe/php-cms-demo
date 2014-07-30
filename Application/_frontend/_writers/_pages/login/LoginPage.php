<?php
  namespace Application\_frontend\_writers\_pages\login;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
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
      $this->source = "writer-templates";
      $this->userType = 'WRITER';
      $this->siteDir = "/writers/";
      $this->siteCache = "/_writers";
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      $this->mongoGen = new MongoGenerator();
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend'.$this->siteCache,
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
      $this->addJS('_writers/login/scripts.min.js');
      $this->setTitle('CEM Writer Dashboard - Log In');
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
     * Processes the Writer login form
     * 
     * @param assoc array $params
     * @access public
     */
    public function processLogin($params){
      $this->mongodb->switchCollection('users');
      $regexEmail = new \MongoRegex("/^".$params['values']['email']."$/i"); 
      $query = $this->mongoGen->logicOp(array(array('email' => $regexEmail), $this->mongoGen->logicOp(array(array('type' => 'WRITER'),array('type' => 'EDITOR')),MongoGenerator::LOGICAL_OR)),MongoGenerator::LOGICAL_AND);
      $userCount = $this->mongodb->getCount($query);
      if($userCount != 1){
        echo 'restricted';
      } else {
        $userInfo = $this->mongodb->getDocument(array('email' => $regexEmail));
        $decryptedPassword = $this->pass_enc->decrypt(base64_decode($userInfo['password']), $this->config->passwords['login']);
        if($decryptedPassword == $params['values']['password']){
          $_SESSION[$this->config->sessionID]['LOGGED_IN'] = true;
          $_SESSION[$this->config->sessionID]['USER_TYPE'] = 'WRITER';
          $_SESSION[$this->config->sessionID]['USER_INFO'] = $userInfo;
          $writerInfo = foo(new MongoAccessLayer('users'))->joinCollectionsByID(array($userInfo), 'writers', '_id');
          $_SESSION[$this->config->sessionID]['WRITER_INFO'] = $writerInfo[0]['writers'];
          $this->applyRateChange($userInfo['_id']);
          echo 'pass';  
        } else {
          echo 'restricted';
        }
      }
    }

    /**
     * Searches the database for the writer by ID, if the writer has a pending rate change, it is applied to their rate.
     *
     * @param MongoId $writer_id
     * @access protected
     */
    protected function applyRateChange($writer_id){
      $this->mongodb->switchCollection('writers');
      $query = $this->mongoGen->logicOp(array(array('_id' => $writer_id),$this->mongoGen->inequalityOp('pending_date',(int)date('U'),MongoGenerator::COMPARE_LTE)),MongoGenerator::LOGICAL_AND);
      $writer = $this->mongodb->getDocument($query, array('_id' => 0, 'writer_rate' => 1, 'pending_rate' => 1, 'pending_date' => 1));
      if($writer != null && $writer['pending_date'] != ''){
        $writer['writer_rate'] = $writer['pending_rate'];
        $writer['pending_rate'] = '';
        $writer['pending_date'] = '';
        foo(new MongoAccessLayer('writers'))->saveDocEntry($writer, (string)$writer_id);
      }
    }
  }
?>