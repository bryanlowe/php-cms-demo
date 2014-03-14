<?php
  namespace Application\_backend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_widgets\SQLForm\_forms as Form;
  
  /**
   * Class: Backend
   *    
   * Creates a template for all Backend pages to use
   */
  class Backend extends Page{

    /**
     * Encryption class object
     *
     * @access protected
     */
    protected $pass_enc = null;
    
    /**
     * Template source directory
     *    
     * @var string $source
     * @access protected
     */
    protected $source = 'backend-templates';
    
    /**
     * Construct a new Backend object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      if(!$_SESSION[$this->config->sessionID]['LOGGED_IN']
      || $_SESSION[$this->config->sessionID]['USER_TYPE'] != "ADMIN"){
        header('Location: /admin/login');
      }
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_backend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize Backend Page Elements
     *    
     * @access public
     */
    public function init(){
      $this->addCSS('_common/bootstrap.css');
      $this->addCSS('_common/sb-admin.css');
      $this->addCSS('font-awesome/css/font-awesome.min.css');
      $this->addCSS('_common/jquery-impromptu.css');
      $this->addCSS('_common/styles.css');
      $this->addJS('_common/jquery-1.10.2.min.js');
      $this->addJS('_common/jquery.idle.min.js');
      $this->addJS('_common/jquery-impromptu.min.js');
      $this->addJS('_common/bootstrap.js');
      $this->addJS('_common/common-functions.js');
      $this->addJS('_widgets/_jsonform/form-functions.min.js');
      $this->addJS('_common/_mongodb/form-functions.min.js');
      //$this->addJS('_widgets/_sqlform/form-functions.min.js');
      $this->setTitle('CEM Dashboard - Admin');
      $this->assemblePage();
    }
    
    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      if(isset($_SESSION[$this->config->sessionID]['USER_INFO'])){
        $this->setDisplayVariables('USER_INFO', $_SESSION[$this->config->sessionID]['USER_INFO']);  
      }
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL);
    } 

    /**
     * Performs save and delete actions for forms. 
     * Calls the specified Form class and saves or deletes entries
     *
     * @param assoc array $param
     * @access public
     */
    public function processBLLForm($params){
      $formNS = 'Application\_engine\_sqlform\_forms';
      if($this->isAdminUser()){
        $class = $formNS.'\\'.$params['form'].'Form';
        if($params['action'] == "SAVE"){
          echo foo(new $class($params['priKey']))->save($params['values']);
        } else if($params['action'] == "DELETE"){
          echo foo(new $class($params['priKey']))->delete($params['priKey']);
        }
      } 
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
          echo $tblInfo['password'];
          if($params['table'] == 'users'){
            $tblInfo['password'] = $this->pass_enc->decrypt(base64_decode($tblInfo['password']), $this->config->passwords['login']);
          }
          echo json_encode(array($tblInfo));  
        } else {
          echo json_encode(foo(new Collection($params['table']))->getAll(null, null, null, $params['order']));  
        }
      }    
    }

    /**
     * Gather BLL Count from the database
     *
     * @param assoc array $param
     * @access public
     */
    public function gatherBLLCount($params){
      if($this->isAdminUser()){
        echo json_encode(foo(new Collection($params['table']))->getCount($params['where']));  
      }    
    }

    /**
     * Gets the doc by _id
     *    
     * @param mixed array $params    
     * @access public
     */
    public function getDocByID($params){
      if($this->isAdminUser()){
        if(isset($params['_id'])){
          $this->mongodb->switchCollection($params['collection']);
          if($params['mongoid']){
            $params['_id'] = new \MongoId($params['_id']);
          }
          $result = $this->mongodb->getDocument(array('_id' => $params['_id']));
          echo json_encode($result);
        }
      }
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveDocEntry($params){
      if($this->isAdminUser()){
        if(isset($params['values']) && isset($params['collection'])){
          $this->mongodb->switchCollection($params['collection']);
          if($params['mongoid']){
            $params['values']['_id'] = ($params['values']['_id'] != '') ? new \MongoId($params['values']['_id']) : new \MongoId();
          }
          $this->mongodb->updateDocument($params['values']);
        }
      }
    }

    /**
     * Deletes a doc from the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function deleteDocEntry($params){
      if($this->isAdminUser()){
        if(isset($params['values']) && isset($params['collection'])){
          $this->mongodb->switchCollection($params['collection']);
          if($params['mongoid']){
            $params['values']['_id'] = new \MongoId($params['values']['_id']);
          }
          $this->mongodb->deleteDocument(array('_id' => $params['values']['_id']));
        }
      }
    }

    /**
     * This function is supposed to be overridden by the inherited class
     *
     * @param $params 
     * @access public
     * @abstract
     */
    public function renderPageElement($params){}

    /**
     * Checks whether the user is logged in and if the login type is ADMIN
     *
     * @return boolean
     * @access protected
     */
    protected function isAdminUser(){
      if($_SESSION[$this->config->sessionID]['LOGGED_IN'] && $_SESSION[$this->config->sessionID]['USER_TYPE'] == "ADMIN"){
        return true;
      }
      return false;  
    }
  }
?>