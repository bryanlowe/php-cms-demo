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
      $this->source = "admin-templates";
      parent::__construct();
      
    }
    
    /**
     * Initialize AppointmentsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Appointment Management');
      $this->setTemplate('appointments/main.html');
    }
  }
?>