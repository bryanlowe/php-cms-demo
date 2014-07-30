<?php
  namespace Application\_frontend\_writers\_pages\logout;
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
      $this->source = "writer-templates";
      $this->userType = 'WRITER';
      $this->siteDir = "/writers/";
      $this->siteCache = "/_writers";
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
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
      $this->setTitle('CEM Writer Dashboard - Log Out');
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
      unset($_SESSION[$this->config->sessionID]['WRITER_INFO']);
      unset($_SESSION[$this->config->sessionID]['USER_TYPE']);
    }
  }
?>