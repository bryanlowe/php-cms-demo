<?php
  namespace Application\_Backend\_admin\_pages\logout;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_core\Register as Register;
  
  /**
   * Class: LogoutPage
   *    
   * Handles the Logout Page
   */
  class LogoutPage extends Backend{

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
      $this->source = "admin-templates";
      $this->unsetAllVars();
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_backend',
          'auto_reload' => true,
          'autoescape' => false
      ));
    }
    
    /**
     * Initialize LogoutPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Log Out');
      $this->setTemplate('logout/main.html');
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