<?php
  namespace Application\_backend\_admin\_pages\projects;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
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
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/projects/scripts.min.js');
      $this->setTitle('CEM Dashboard - Project Management');
      $this->setTemplate('projects/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $projectForm = foo(new Form('projects'))->getFormHTML();
      $this->setDisplayVariables('PROJECT_FORM', $projectForm);
      $projectStatusForm = foo(new Form('project_status'))->getFormHTML();
      $this->setDisplayVariables('PROJECT_STATUS_FORM', $projectStatusForm);
    }

    /**
     * Gets entries from the project status table by the project id
     *
     * @param assoc array $param
     * @access public
     */
    public function getProjectStatus($params){
      if($this->isAdminUser()){
        $where = "project_id = ".$this->db->quote($params['projectID']);
        echo json_encode(foo(new Collection('project_status'))->getByQuery($where));
      }
    }   
  }
?>