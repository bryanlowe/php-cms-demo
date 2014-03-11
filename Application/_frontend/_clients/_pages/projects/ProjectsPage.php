<?php
  namespace Application\_frontend\_clients\_pages\projects;
  use Application\_frontend\Frontend as Frontend;
  use Application\_engine\_bll\_collection\ProjectsCollection as ProjectsCollection;
  use Application\_engine\_bll\_collection\ProjectStatusCollection as ProjectStatusCollection;
  
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
      $this->addJS('_clients/projects/scripts.min.js');
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
      $this->setDisplayVariables('PROJECT_ENTRIES', $this->getProjectRecords());
    }

    /**
     * Get recent projects
     *    
     * @access private
     */
    private function getProjectRecords(){
      $projectEntries = array();
      $resultStr = "";
      $records = foo(new ProjectsCollection())->getByQuery('client_id = '.$this->db->quote($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id']));
      if(($maxRecords = count($records)) > 0){
        for($i = 0; $i < $maxRecords; $i++){
          $status = foo(new ProjectStatusCollection())->getByQuery('project_id = '.$this->db->quote($records[$i]['project_id']));
          $status = array_shift($status);
          $statusDesc = "No status has been reported at this time.";
          $statusState = "N/A";
          $statusDate = "N/A";
          if(count($status) > 0){
            $statusDesc = ($status['description'] != "" && isset($status['description'])) ? $status['description'] : $statusDesc;
            $statusState = ($status['status'] != "" && isset($status['status'])) ? $status['status'] : $statusState;
            $statusDate = date("Y-m-d H:i:s", strtotime($status['project_status_date']));
          }
          $projectEntries[] = array('project_id' => $records[$i]['project_id'], 'project_title' => $records[$i]['project_title'], 'update_date' => $statusDate, 'description' => $records[$i]['description'], 'status' => $statusState, 'status_desc' => $statusDesc);
        } 
      }
      return $projectEntries;
    }
  }
?>