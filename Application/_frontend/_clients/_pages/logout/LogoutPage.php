<?php
  namespace Application\_frontend\_clients\_pages\logout;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Register as Register;
  
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
      $this->source = "client-templates";
      $this->siteCache = "/_clients";
      $this->unsetAllVars();
      $this->loader = new \Twig_Loader_Filesystem($this->config->dir($this->source));
      $this->twig = new \Twig_Environment($this->loader, array(
          'cache' => $this->config->dir('temp-cache').'/_twig/_frontend',
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
      unset($_SESSION[$this->config->sessionID]['CLIENT_INFO']);
      unset($_SESSION[$this->config->sessionID]['USER_TYPE']);
    }
  }
?>