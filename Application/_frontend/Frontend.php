<?php
  namespace Application\_frontend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_db\_mysql\DB as DB;
  use Framework\_engine\_db\_mysql\SQLGenerator as SQLGenerator;
  
  /**
   * Class: Frontend
   *    
   * Creates a template for all frontend pages to use
   */
  class Frontend extends Page{

    /**
     * Encryption class object
     *
     * @access protected
     */
    protected $pass_enc = null;

    /**
     * User Type
     *
     * @access protected 
     */
    protected $userType = "CLIENT";

    /**
     * site dir
     *
     * @access protected 
     */
    protected $siteDir = "/";

    /**
     * Template config directory
     *    
     * @var string $source
     * @access protected
     */
    protected $source = 'frontend-templates';
    
    /**
     * Construct a new Frontend object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      if(!$_SESSION[$this->config->sessionID]['LOGGED_IN']
      || $_SESSION[$this->config->sessionID]['USER_TYPE'] != $this->userType){
        header('Location: '.$this->siteDir.'login');
      }
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize Frontend Page Elements
     *    
     * @access public
     */
    public function init(){
      $this->addCSS('_cem/bootstrap.min.css');
      $this->addCSS('font-awesome/css/font-awesome.min.css');
      $this->addCSS('_common/jquery-impromptu.css');
      $this->addCSS('_cem/styles.css');
      $this->addJS('_common/jquery-1.10.2.min.js');
      $this->addJS('_common/jquery.idle.min.js');
      $this->addJS('_common/jquery-impromptu.js');
      $this->addJS('_cem/bootstrap.min.js');
      $this->addJS('_common/common-functions.js');
      $this->addJS('_widgets/_jsonform/form-functions.js');
      $this->addJS('_widgets/_sqlform/form-functions.js');
      $this->setTitle('CEM Dashboard');
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
      $this->setDisplayVariables('COPY_YEAR', date('Y'));
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
      if($this->isLoggedIn()){
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
      if($this->isLoggedIn()){
        $where = "";
        if($params['bllAction'] == "SELECTION"){
          echo json_encode(array(foo(new Selection($params['table']))->getByID($params['primaryKey'])->getValues()));  
        } else {
          echo json_encode(foo(new Collection($params['table']))->getAll(null, null, null, $params['order']));  
        }
      }    
    }

    /**
     * Checks whether the user is logged in and if the login type is CLIENT
     *
     * @return boolean
     * @access protected
     */
    protected function isClientUser(){
      if($_SESSION[$this->config->sessionID]['LOGGED_IN'] && $_SESSION[$this->config->sessionID]['USER_TYPE'] == "CLIENT"){
        return true;
      }
      return false;  
    }

    /**
     * Checks whether the user is logged in and if the login type is WRITER
     *
     * @return boolean
     * @access protected
     */
    protected function isWriterUser(){
      if($_SESSION[$this->config->sessionID]['LOGGED_IN'] && $_SESSION[$this->config->sessionID]['USER_TYPE'] == "WRITER"){
        return true;
      }
      return false;  
    }

    /**
     * Checks whether the user is logged in
     *
     * @return boolean
     * @access protected
     */
    protected function isLoggedIn(){
      if($this->isClientUser() || $this->isWriterUser()){
        return true;
      }
      return false;  
    }
  }
?>