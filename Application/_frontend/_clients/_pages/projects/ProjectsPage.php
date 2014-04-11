<?php
  namespace Application\_frontend\_clients\_pages\projects;
  use Application\_frontend\Frontend as Frontend;
  
  /**
   * Class: ProjectsPage
   *    
   * Handles the Projects Page
   */
  class ProjectsPage extends Frontend{

    /**
     * Construct a new ProjectsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "client-templates";
      parent::__construct();
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_clients/projects/scripts.js');
      $this->setTitle('CEM Dashboard - View Project Details');
      $this->setTemplate('projects/main.html');
    }
    
    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('projects');
      $result =  $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('client_id' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'])),$this->mongoGen->sortStage(array("project_date" => -1))));
      $project_entries = $result['result'];
      $this->setDisplayVariables('PROJECT_ENTRIES', $project_entries);
    }
  }
?>