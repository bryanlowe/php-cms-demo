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
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('CEM Dashboard - Project Management');
    }

    /**
     * Set ProjectsPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set ProjectsPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('projects/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $projectForm = foo(new Form('projects'))->getFormHTML();
      $this->setDisplayVariables('PROJECT_FORM', $projectForm, 'BODY');
      $projectStatusForm = foo(new Form('project_status'))->getFormHTML();
      $this->setDisplayVariables('PROJECT_STATUS_FORM', $projectStatusForm, 'BODY');
    }

    /**
     * Set ProjectsPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('admin-templates') . '/projects/scripts.html');
      $this->setDisplayVariables('SITE_URL', $this->config->homeURL, 'FOOTER');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
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