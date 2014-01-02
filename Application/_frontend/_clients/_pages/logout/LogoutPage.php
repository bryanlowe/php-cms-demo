<?php
  namespace Application\_frontend\_pages\logout;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_engine\_dal\Selection as Selection;
  
  /**
   * Class: LogoutPage
   *    
   * Handles the Logout Page
   */
  class LogoutPage extends Frontend{

    /**
     * Construct a new LogoutPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');
      $this->pageRequests = Register::getInstance()->get('pageRequests');
      $this->db = Register::getInstance()->get('db');
      $this->uri = Register::getInstance()->get('uri');
      $this->unsetAllVars();
    }
    
    /**
     * Initialize LogoutPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('EvTools CMS - Log Out');
    }

    /**
     * Set LogoutPage header
     *    
     * @access protected
     */
    protected function header(){
      $this->setHeader("logout/header.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'HEADER');
    }

    /**
     * Set LogoutPage footer
     *    
     * @access protected
     */
    protected function footer(){
      $this->setFooter("logout/footer.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'FOOTER');
    }
    
    /**
     * Set LogoutPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('logout/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
    }

    /**
     * Unsets all site variables
     *    
     * @access private
     */    
    private function unsetAllVars(){
      $_SESSION[$this->config->sessionID]['LOGGED_IN'] = false;
      if(isset($_SESSION[$this->config->sessionID]['CLIENT_INFO'])){
        /**
         * Remove the client from lockedclients if it exists in table
         */
        $clients = foo(new Collection("lockedclients"))->getByQuery('client_id = "'.$_SESSION[$this->config->sessionID]['CLIENT_INFO']["client_id"].'"');
        $clientCount = count($clients);
        if($clientCount > 0){
          for($i = 0; $i < $clientCount; $i++){
            foo(new Selection('lockedclients'))->deleteByID($clients[$i]["lockedclient_id"]);
          }
        }
        unset($_SESSION[$this->config->sessionID]['CLIENT_INFO']);
      }
      if(isset($_SESSION[$this->config->sessionID]['WEBSERVER_INFO'])){
        unset($_SESSION[$this->config->sessionID]['WEBSERVER_INFO']);
      }
      unset($_SESSION[$this->config->sessionID]['USER_INFO']);
      unset($_SESSION[$this->config->sessionID]['USER_TYPE']);
    }
  }
?>