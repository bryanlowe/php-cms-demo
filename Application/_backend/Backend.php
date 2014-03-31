<?php
  namespace Application\_backend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: Backend
   *    
   * Creates a template for all Backend pages to use
   */
  class Backend extends Page{

    /**
     * MongoGenerator Object
     *
     * @access protected
     */
    protected $mongoGen = null;

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
      if(!$_SESSION[$this->config->sessionID]['LOGGED_IN']
      || $_SESSION[$this->config->sessionID]['USER_TYPE'] != "ADMIN"){
        header('Location: /admin/login');
      }
      $this->mongoGen = new MongoGenerator();
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
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
      $this->addJS('_common/_mongodb/form-functions.js');
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
     * Gets the doc by _id
     *    
     * @param mixed array $params    
     * @access public
     */
    public function getEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['collection']))->getDocByID($params['_id'], $params['mongoid']);
        echo json_encode($results);
      }
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->saveDocEntry($params['doc']['values'], $params['doc']['_id']);
        echo json_encode($results);
      }
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->addSetToDocEntry($params['doc']['set'], $params['doc']['values'], $params['doc']['_id'], $params['doc']['mongoid']);
        echo json_encode($results);
      }    
    }

    /**
     * Removes a set value from the doc in the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function removeSetFromEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->pullSetFromDocEntry($params['doc']['set'], $params['doc']['values'], $params['doc']['_id'], $params['doc']['mongoid']);
        echo json_encode($results);
      }    
    }

	  /**
     * Deletes a doc from the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function deleteEntry($params){
      if($this->isAdminUser()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->deleteDocEntry($params['doc']['_id'], $params['doc']['mongoid']);
        echo json_encode($results);
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