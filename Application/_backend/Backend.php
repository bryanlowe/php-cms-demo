<?php
  namespace Application\_backend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
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
      $this->addJS('_widgets/_jsonform/form-functions.js');
      $this->addJS('_widgets/_sqlform/form-functions.min.js');
      $this->docHeader();
      $this->header();
      $this->body();
      $this->footer();
      $this->setTitle('CEM Dashboard - Admin');
    }
    
    /**
     * Set Backend Page templates
     *    
     * @access protected
     */
    protected function setTemplate($template, $source = null){
      $source = ($source == null) ? $this->source : $source;
      return parent::setTemplate($template, $source);
    }

    /**
     * Set Backend Page header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
      $this->setDisplayVariables('USER_EMAIL', $_SESSION[$this->config->sessionID]['USER_INFO']['email'], 'HEADER');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'HEADER');
    }
    
    /**
     * Set Backend Page footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $source = ($source == null) ? $this->source : $source;
      $scripts = file_get_contents($this->config->dir($source) . '/_common/scripts.html');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'FOOTER');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }
    
    /**
     * Set Backend Page DocHeader Template
     *    
     * @access protected
     */
    protected function setDocHeader($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['DOCHEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/docheader.html');
    }
    
    /**
     * Set Backend Page Header Template
     *    
     * @access protected
     */ 
    protected function setHeader($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['HEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/header.html');
    }
    
    /**
     * Set Backend Page Footer Template
     *    
     * @access protected
     */ 
    protected function setFooter($template = null){
      $source = ($source == null) ? $this->source : $source;
      $this->pageElements['FOOTER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir($source) . '/' .$template) : file_get_contents($this->config->dir($source) . '/_common/footer.html');
    }
     
    /**
     * Set Backend Page Body Template
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
     * @access public
     */
    public function gatherBLLResource($params){
      if($this->isAdminUser()){
        $where = "";
        if($params['bllAction'] == "SELECTION"){
          echo json_encode(array(foo(new Selection($params['table']))->getByID($params['primaryKey'])->getValues()));  
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