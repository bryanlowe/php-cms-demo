<?php
  namespace Application\_frontend\_writers\_pages\account;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: AccountPage
   *    
   * Handles the Account Page
   */
  class AccountPage extends Frontend{
    /**
     * Construct a new AccountPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "writer-templates";
      $this->userType = 'WRITER';
      $this->siteDir = "/writers/";
      $this->siteCache = "/_writers";
      parent::__construct();
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
    }
    
    /**
     * Initialize AccountPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_common/jquery-ui.css');
      $this->addJS('_common/jquery-ui.js');
      $this->addJS('_writers/account/scripts.min.js');
      $this->setTitle('CEM Writer Dashboard - Edit Account');
      $this->setTemplate('account/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();  
      $writerInfo = $_SESSION[$this->config->sessionID]['WRITER_INFO'];
      $writerInfo['_id'] = (string) $writerInfo['_id'];
      $writerInfo['password'] = $this->pass_enc->decrypt(base64_decode($_SESSION[$this->config->sessionID]['USER_INFO']['password']), $this->config->passwords['login']);
      $writerForm = foo(new FormGenerator($this->config->dir($this->source).'/account/writers_form.json', $writerInfo))->getFormHTML();
      $this->setDisplayVariables('WRITER_FORM', $writerForm);
      $this->mongodb->switchCollection('feedback');
      $query = $this->mongoGen->logicOp(array(array('writer_id' => new \MongoId($_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'])), $this->mongoGen->inequalityOp('date',(string)strtotime('-1 month'),MongoGenerator::COMPARE_GTE)),MongoGenerator::LOGICAL_AND);
      $pipeline = array(
        $this->mongoGen->projectStage(array("writer_id" => 1, "date" => 1, "rating" => 1, "words_per_hour" => 1)),
        $this->mongoGen->matchStage($query),
        $this->mongoGen->groupStage(array('_id' => null, 'avg_rating' => array('$avg' => '$rating'), 'avg_wph' => array('$avg' => '$words_per_hour')))
      );
      $feedback = $this->mongodb->aggregateDocs($pipeline);
      $this->setDisplayVariables('RATING', $feedback['result'][0]['avg_rating']);
      $this->setDisplayVariables('WPH', $feedback['result'][0]['avg_wph']);
      $this->setDisplayVariables('AS_OF_DATE', date('m/d/Y', strtotime('-1 month')));
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      $duplicate = false;
      // catch duplicate entries. If there is a duplicate, send an error for account changes
      $this->mongodb->switchCollection('users');
      $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
      $userCount = $this->mongodb->getCount(array('email' => $regexEmail));
      if($userCount > 0 && strtolower($params['doc']['values']['email']) != strtolower($_SESSION[$this->config->sessionID]['WRITER_INFO']['email'])){
        $duplicate = true;
      }
      // catch duplicate entries. If there is a duplicate, send an error for account changes
      if(!$duplicate){
        $writer = array(
          'writer_name' => $params['doc']['values']['writer_name'],
          'email' => $params['doc']['values']['email']
        );
        $user = array(
          'fullname' => $params['doc']['values']['writer_name'],
          'password' => base64_encode($this->pass_enc->encrypt($params['doc']['values']['password'], $this->config->passwords['login'])),
          'email' => $params['doc']['values']['email']
        );
        foo(new MongoAccessLayer('users'))->saveDocEntry($user, $params['doc']['_id']);
        $result = foo(new MongoAccessLayer('writers'))->saveDocEntry($writer, $params['doc']['_id']);
        echo json_encode($result);
        $this->mongodb->switchCollection('writers');
        $_SESSION[$this->config->sessionID]['WRITER_INFO'] = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
      } else {
        echo json_encode(array('err' => 'This email already exists. Please use a different email.'));
      }  
    }
  }
?>