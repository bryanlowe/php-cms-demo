<?php
  namespace Application\_backend\_admin\_pages\appointments;
  use Application\_backend\Backend as Backend;
  
  /**
   * Class: AppointmentsPage
   *    
   * Handles the Appointments Page
   */
  class AppointmentsPage extends Backend{

    /**
     * Construct a new AppointmentsPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize AppointmentsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Appointment Management');
    }

    /**
     * Set AppointmentsPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set AppointmentsPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('appointments/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
    }

    /**
     * Set AppointmentsPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('admin-templates') . '/appointments/scripts.html');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'FOOTER');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }
  }
?>