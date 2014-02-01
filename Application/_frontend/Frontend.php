<?php
  namespace Application\_frontend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_db\DB as DB;
  use Framework\_engine\_db\SQLGenerator as SQLGenerator;
  
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
      $this->docHeader();
      $this->header();
      $this->body();
      $this->footer();
      $this->setTitle('CEM Dashboard');
    }
    
    /**
     * Set Frontend Page templates
     *    
     * @access protected
     */
    protected function setTemplate($template, $source = null){
      $source = ($source == null) ? $this->source : $source;
      return parent::setTemplate($template, $source);
    }

    /**
     * Set Frontend Page header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
      $this->setDisplayVariables('USER_NAME', $_SESSION[$this->config->sessionID]['USER_INFO']['user_name'], 'HEADER');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'HEADER');
    }
    
   /**
     * Set Frontend Page footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $source = ($source == null) ? $this->source : $source;
      $scripts = file_get_contents($this->config->dir($source) . '/_common/scripts.html');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'FOOTER');
      $this->setDisplayVariables('COPY_YEAR', date('Y'), 'FOOTER');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }
    
    /**
     * Set Frontend Page DocHeader Template
     *    
     * @access protected
     */
    protected function setDocHeader($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['DOCHEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/docheader.html');
    }
    
    /**
     * Set Frontend Page Header Template
     *    
     * @access protected
     */ 
    protected function setHeader($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['HEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/header.html');
    }
    
    /**
     * Set Frontend Page Footer Template
     *    
     * @access protected
     */ 
    protected function setFooter($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['FOOTER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/footer.html');
    }
     
    /**
     * Set Frontend Page Body Template
     *    
     * @access protected
     */ 
    protected function setBody($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['BODY']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/general.html');
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