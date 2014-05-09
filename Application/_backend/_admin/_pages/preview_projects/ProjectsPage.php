<?php
  namespace Application\_backend\_admin\_pages\preview_projects;
  use Application\_backend\Backend as Backend;
  
  /**
   * Class: ProjectsPage
   *    
   * Handles the Projects Page
   */
  class ProjectsPage extends Backend{

    /**
     * Construct a new ProjectsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
      $this->client_select_pipeline = array(
        $this->mongoGen->projectStage(array("company" => 1, "client_name" => 1)),
        $this->mongoGen->sortStage(array("client_name" => 1, 'company' => 1))
      );
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_admin/preview-projects/scripts.min.js');
      $this->setTitle('CEM Dashboard - View Project Details');
      $this->setTemplate('preview-projects/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('clients');
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients['result']);
    }

    /**
     * Reloads the project list
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'project_entries'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('projects');
          $pipeline = array(
            $this->mongoGen->matchStage(array('client_id' => (new \MongoId($params['_id'])), 'invoiced' => 0)),
            $this->mongoGen->sortStage(array('project_date' => -1))
          );
          $results = $this->mongodb->aggregateDocs($pipeline);
          $select_projects = $results['result']; 
          $maxResults = count($select_projects);
          for($i = 0; $i < $maxResults; $i++){
            $select_projects[$i]['project_date'] = date('m-d-Y h:ia', $select_projects[$i]['project_date']).' EST';
          }
          echo $this->twig->render('preview-projects/project-entry.html', array('PROJECT_ENTRIES' => $select_projects));        
        } else {
          echo $this->twig->render('preview-projects/project-entry.html', array('PROJECT_ENTRIES' => array()));        
        }
      }
    }
  }
?>