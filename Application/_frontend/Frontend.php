<?php
  namespace Application\_frontend;
  use Framework\_engine\_core\Page as Page;
  use Application\_tools\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  use Framework\_engine\_db\DB as DB;
  use Framework\_engine\_db\SQLGenerator as SQLGenerator;
  
  /**
   * Class: Frontend
   *    
   * Creates a template for all frontend pages to use
   */
  class Frontend extends Page{

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
      /*
      if(!$_SESSION[$this->config->sessionID]['LOGGED_IN']){
        header('Location: https://test.evenue.net/cms/login');
      } else if($_SESSION[$this->config->sessionID]['USER_TYPE'] != "NORM"){
        header('Location: https://test.evenue.net/cms/login');
      }
      */
    }
    
    /**
     * Initialize Frontend Page Elements
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
      $this->addJS('_common/jquery-impromptu.js');
      $this->addJS('_common/bootstrap.js');
      $this->addJS('_common/common-functions.js');
      $this->addJS('_tools/jsonform/form-functions.js');
      $this->addJS('_tools/sqlform/form-functions.js');
      $this->docHeader();
      $this->header();
      $this->body();
      $this->footer();
      $this->setTitle('EvTools CMS');
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
      $this->setDisplayVariables('USER_EMAIL', $_SESSION[$this->config->sessionID]['USER_INFO']['email'], 'HEADER');
      $webserverLabel = (isset($_SESSION[$this->config->sessionID]['WEBSERVER_INFO'])) ? "Webserver: ".$_SESSION[$this->config->sessionID]['WEBSERVER_INFO']['webserver_name'] : "Please select a webserver";
      $this->setDisplayVariables('WEBSERVER_LABEL', $webserverLabel, 'HEADER');
      $clientLabel = (isset($_SESSION[$this->config->sessionID]['CLIENT_INFO'])) ? "Client: ".$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name']." - ".$_SESSION[$this->config->sessionID]['CLIENT_INFO']['link_id'] : "Please select a client";
      $this->setDisplayVariables('CLIENT_LABEL', $clientLabel, 'HEADER');
    }
    
    /**
     * Set Frontend Page footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $clientForm = foo(new FormGenerator(null, $this->config->dir('frontend-templates').'/_common/client_form.json'))->getFormHTML();
      $this->setDisplayVariables('CLIENT_FORM', $clientForm, 'FOOTER');
      $webserverForm = foo(new FormGenerator(null, $this->config->dir('frontend-templates').'/_common/webserver_form.json'))->getFormHTML();
      $this->setDisplayVariables('WEBSERVER_FORM', $webserverForm, 'FOOTER');
      $scripts = file_get_contents($this->config->dir('frontend-templates') . '/_common/scripts.html');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }
    
    /**
     * Set Frontend Page DocHeader Template
     *    
     * @access protected
     */
    protected function setDocHeader($template = null){
       $this->pageElements['DOCHEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir('frontend-templates') . '/' .$template) : file_get_contents($this->config->dir('frontend-templates') . '/_common/docheader.html');
    }
    
    /**
     * Set Frontend Page Header Template
     *    
     * @access protected
     */ 
    protected function setHeader($template = null){
       $this->pageElements['HEADER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir('frontend-templates') . '/' .$template) : file_get_contents($this->config->dir('frontend-templates') . '/_common/header.html');
    }
    
    /**
     * Set Frontend Page Footer Template
     *    
     * @access protected
     */ 
    protected function setFooter($template = null){
       $this->pageElements['FOOTER']['SOURCE'] = ($template) ? file_get_contents($this->config->dir('frontend-templates') . '/' .$template) : file_get_contents($this->config->dir('frontend-templates') . '/_common/footer.html');
    }
     
    /**
     * Set Frontend Page Body Template
     *    
     * @access protected
     */ 
    protected function setBody($template = null){
       $this->pageElements['BODY']['SOURCE'] = ($template) ? file_get_contents($this->config->dir('frontend-templates') . '/' .$template) : file_get_contents($this->config->dir('frontend-templates') . '/_common/general.html');
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
     * Gather BLL Resources from the database by user group
     *
     * @param assoc array $param
     * @access public
     */
    public function gatherAllowedResource($params){
      if($this->isLoggedIn()){
        $join = "";
        $fields = array();
        $tables = array();
        if($params['table'] == "clients"){
          $fields = array("clients" => array("*"), "clientaccess" => array());
          $tables = array("clientaccess" => array("join" => "INNER JOIN", "on" => 'clients.client_id = clientaccess.client_id AND clientaccess.usergroup_id = '.$this->db->quote($_SESSION[$this->config->sessionID]['USER_INFO']['usergroup_id'])));
        } else if($params['table'] == "webservers"){
          $fields = array("webservers" => array("*"), "webserveraccess" => array());
          $tables = array("webserveraccess" => array("join" => "INNER JOIN", "on" => 'webservers.webserver_id = webserveraccess.webserver_id AND webserveraccess.usergroup_id = '.$this->db->quote($_SESSION[$this->config->sessionID]['USER_INFO']['usergroup_id'])));
        }
        $join = foo(new SQLGenerator($params['table']))->join($fields, $tables);
        $join .= ' ORDER BY '.$params['order'];
        echo json_encode($this->db->rows($join, array()));
      }    
    }

    /**
     * Checks if a client is locked in the database. If not then the client is locked under the current user
     *
     * @param assoc array $param
     * @access public
     */
    public function lockClient($params){
      if($this->isLoggedIn()){
        $userWhere = 'user_id = "'.$_SESSION[$this->config->sessionID]['USER_INFO']['user_id'].'"';
        $clientWhere = 'client_id = "'.addslashes($params["client_id"]).'"';
        $lockedClients = foo(new Collection("lockedclients"))->getByQuery($clientWhere);
        if(count($lockedClients) > 0){
          $lockedClients = array_shift($lockedClients);
          if($lockedClients["user_id"] == $_SESSION[$this->config->sessionID]['USER_INFO']['user_id']){
            $message = "This client is already locked by this user: ".$_SESSION[$this->config->sessionID]['USER_INFO']['email'];
            echo json_encode(array("message" => $message));
          } else {
            $user = foo(new Selection('users'))->getByID($lockedClients["user_id"]);
            $message = "This client is locked by user: ".$user->getValues("email");
            echo json_encode(array("message" => $message));
          }
        } else {
          /**
           * Remove the user from lockedclients if it exists in table
           */
          $user = foo(new Collection("lockedclients"))->getByQuery($userWhere);
          $userCount = count($user);
          if($userCount > 0){
            for($i = 0; $i < $userCount; $i++){
              foo(new Selection('lockedclients'))->deleteByID($user[$i]["lockedclient_id"]);
            }
          }

          /**
           * Add entry into lockedclients
           */
          $entryVals = array("lockedclient_id" => "", "client_id" => $params["client_id"], "user_id" =>$_SESSION[$this->config->sessionID]['USER_INFO']['user_id']);
          $entry = foo(new Selection('lockedclients'))->getByID(null);
          $entry->setValues($entryVals);
          foo(new Selection('lockedclients'))->save($entry);
          $message = "This client is now locked by user: ".$_SESSION[$this->config->sessionID]['USER_INFO']['email'];
          $clientArr = foo(new Collection("clients"))->getByQuery($clientWhere);
          $client = array_shift($clientArr);
          $_SESSION[$this->config->sessionID]['CLIENT_INFO'] = $client;
          echo json_encode(array("message" => $message, "client" => $client));
        }
      }    
    }

    /**
     * Updates the webserver used by the current user
     *
     * @param assoc array $param
     * @access public
     */
    public function updateWebserver($params){
      if($this->isLoggedIn()){
        $where = 'webserver_id = "'.addslashes($params["webserver_id"]).'"';
        $webserver = foo(new Collection("webservers"))->getByQuery($where); 
        if(count($webserver) > 0){
          $webserver = array_shift($webserver);
          $message = "Current webserver has been updated to ".$webserver["webserver_name"];
          $_SESSION[$this->config->sessionID]['WEBSERVER_INFO'] = $webserver;
          echo json_encode(array("message" => $message, "webserver_name" => $webserver["webserver_name"])); 
        }
      } 
    }

    /**
     * Checks whether the user is logged in and if the login type is NORM
     *
     * @return boolean
     * @access protected
     */
    protected function isLoggedIn(){
      if($_SESSION[$this->config->sessionID]['LOGGED_IN'] && $_SESSION[$this->config->sessionID]['USER_TYPE'] == "NORM"){
        return true;
      }
      return false;  
    }
  }
?>