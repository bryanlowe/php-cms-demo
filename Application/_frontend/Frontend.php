<?php
  namespace Application\_frontend;
  use Framework\_engine\_core\Page as Page;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_core\Encryption as Encryption;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
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
     * site cache folder for Twig
     *
     * @access protected 
     */
    protected $siteCache = "";

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
      $this->mongoGen = new MongoGenerator();
      $this->pass_enc = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
      if(!$_SESSION[$this->config->sessionID]['LOGGED_IN']
      || $_SESSION[$this->config->sessionID]['USER_TYPE'] != $this->userType){
        header('Location: '.$this->siteDir.'login');
      }
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend'.$this->siteCache,
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
      $this->addCSS('_common/pure-min.css');
      $this->addCSS('_cem/styles.css');
      $this->addJS('_common/jquery-1.10.2.min.js');
      $this->addJS('_common/jquery.idle.min.js');
      $this->addJS('_common/jquery-impromptu.js');
      $this->addJS('_cem/bootstrap.min.js');
      $this->addJS('_common/common-functions.js');
      $this->addJS('_common/_mongodb/form-functions.min.js');
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
     * Gets the doc by _id
     *    
     * @param mixed array $params    
     * @access public
     */
    public function getEntry($params){
      if($this->isLoggedIn()){
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
      if($this->isLoggedIn()){
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
      if($this->isLoggedIn()){
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
      if($this->isLoggedIn()){
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
      if($this->isLoggedIn()){
        $results = foo(new MongoAccessLayer($params['doc']['collection']))->deleteDocEntry($params['doc']['_id'], $params['doc']['mongoid']);
        echo json_encode($results);
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
      if($_SESSION[$this->config->sessionID]['LOGGED_IN'] 
      && ($_SESSION[$this->config->sessionID]['USER_TYPE'] == "WRITER"
      || $_SESSION[$this->config->sessionID]['USER_TYPE'] == "EDITOR")){
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