<?php
  namespace Application\_frontend\_clients\_pages\logout;
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
      $this->source = "client-templates";
      $this->unsetAllVars();
    }
    
    /**
     * Initialize LogoutPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Log Out');
    }

    /**
     * Set LogoutPage header
     *    
     * @access protected
     */
    protected function header(){
      $this->setHeader("logout/header.html");
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'HEADER');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'HEADER');
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
      unset($_SESSION[$this->config->sessionID]['USER_INFO']);
      unset($_SESSION[$this->config->sessionID]['USER_TYPE']);
    }
  }
?>