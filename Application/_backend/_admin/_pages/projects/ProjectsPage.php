<?php
  namespace Application\_backend\_admin\_pages\projects;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  
  /**
   * Class: ProjectsPage
   *    
   * Handles the Projects Page
   */
  class ProjectsPage extends Backend{

    /**
     * Client Select Pipeline - this is an aggregation pipeline of values that are needed for the client select drop down
     * 
     * mixed array
     * @access private
     */
    private $client_select_pipeline = array();

    /**
     * Project Select Pipeline - this is an aggregation pipeline of values that are needed for the project select drop down
     * 
     * mixed array
     * @access private
     */
    private $project_select_pipeline = array();

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
      $this->project_select_pipeline = array(
        $this->mongoGen->projectStage(array("project_title" => 1, "client_id" => 1)),
        $this->mongoGen->sortStage(array("project_title" => 1))
      );
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/projects/scripts.js');
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
      $this->mongodb->switchCollection('projects');
      $projectForm = foo(new FormGenerator($this->config->dir($this->source).'/projects/projects_form.json'))->getFormHTML();
      $this->setDisplayVariables('PROJECT_FORM', $projectForm);
      $results = $this->mongodb->aggregateDocs($this->project_select_pipeline);
      $select_projects = foo(new MongoAccessLayer('projects'))->joinCollectionsByID($results['result'], 'clients', 'client_id'); 
      $this->setDisplayVariables('SELECT_PROJECTS', $select_projects);
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients['result']);
    } 

    /**
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'projects_select_container'){
        $this->mongodb->switchCollection('projects');
        $results = $this->mongodb->aggregateDocs($this->project_select_pipeline);
        $select_projects = foo(new MongoAccessLayer('projects'))->joinCollectionsByID($results['result'], 'clients', 'client_id');
        echo $this->twig->render('projects/projects_select.html', array('SELECT_PROJECTS' => $select_projects));
      } else if($params['dom_id'] == 'clients_select_container'){
        $this->mongodb->switchCollection('clients');
        $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
        echo $this->twig->render('projects/clients_select.html', array('SELECT_CLIENTS' => $select_clients['result']));
      } else if($params['dom_id'] == 'project_tags_container'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('clients');
          $result = $this->mongodb->getDocument(array("_id" => new \MongoId($params['_id'])),array("_id" => 0, "project_tags" => 1));
          echo $this->twig->render('projects/tag_select.html', array('SELECT_TAGS' => $result['project_tags']));
        } else {
          echo $this->twig->render('projects/tag_select.html', array('SELECT_TAGS' => array()));
        }
      } else if($params['dom_id'] == 'current_tags'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('projects');
          $result = $this->mongodb->getDocument(array("_id" => new \MongoId($params['_id'])),array("_id" => 0, "project_tags" => 1));
          echo $this->twig->render('projects/current_tags.html', array('SELECT_TAGS' => $result['project_tags']));
        } else {
          echo $this->twig->render('projects/current_tags.html', array('SELECT_TAGS' => array()));
        }
      }
    }

    /**
     * Saves the form entry to the database
     *
     * @param mixed array $params
     * @access public
     */
    public function saveEntry($params){
      if(isset($params['doc']['values']['client_id'])){
        $params['doc']['values']['client_id'] = new \MongoId($params['doc']['values']['client_id']);
      }
      if($params['doc']['_id'] == ""){
        $params['doc']['values']['invoiced'] = 0;  
      }
      $params['doc']['values']['project_date'] = date("U");
      parent::saveEntry($params);
    }
  }
?>