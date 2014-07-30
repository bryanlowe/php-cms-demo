<?php
  namespace Application\_frontend\_writers\_pages\projects;
  use Application\_frontend\Frontend as Frontend;
  
  /**
   * Class: ProjectsPage
   *    
   * Handles the Projects Page
   */
  class ProjectsPage extends Frontend{

    /**
     * Writer Select Pipeline - this is an aggregation pipeline of values that are needed for the writer select drop down
     * 
     * mixed array
     * @access private
     */
    private $writer_select_pipeline = array();

    /**
     * Construct a new ProjectsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "writer-templates";
      $this->userType = 'WRITER';
      $this->siteDir = "/writers/";
      $this->siteCache = "/_writers";
      parent::__construct();
      if(substr_count($this->config->homeURL, 'writers') == 0){
        $this->config->homeURL = $this->config->homeURL . "/writers";
      }
      $this->writer_select_pipeline = array(
        $this->mongoGen->projectStage(array("writer_name" => 1)),
        $this->mongoGen->sortStage(array("writer_name" => 1))
      );
    }
    
    /**
     * Initialize ProjectsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_widgets/_jquery_ui/ui-darkness/jquery-ui-1.10.4.custom.min.css');
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_widgets/_jquery_ui/jquery-ui-1.10.4.custom.min.js');
      $this->addJS('_writers/projects/scripts.min.js');
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
      $result = null;
      if($_SESSION[$this->config->sessionID]['WRITER_INFO']['writer_type'] == "EDITOR"){
        $result = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('invoiced' => 0)),$this->mongoGen->sortStage(array("project_date" => -1))));  
      } else {
        $result = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('invoiced' => 0, 'assigned_writers' => $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'])),$this->mongoGen->sortStage(array("project_date" => -1))));
      }
      $project_entries = $result['result'];
      $maxResults = count($project_entries);
      for($i = 0; $i < $maxResults; $i++){
        $project_entries[$i]['project_date'] = date('m-d-Y h:ia', $project_entries[$i]['project_date']).' EST';
      }
      $this->setDisplayVariables('PROJECT_ENTRIES', $project_entries);
      $this->setDisplayVariables('WRITER_TYPE', $_SESSION[$this->config->sessionID]['WRITER_INFO']['writer_type']);
      $this->mongodb->switchCollection('writers');
      $select_writers = $this->mongodb->aggregateDocs($this->writer_select_pipeline);
      $this->setDisplayVariables('SELECT_WRITERS', $select_writers['result']);
    }

    /**
     * Reloads the dom elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'hour-list'){
        $this->displayProjectHours($params, $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id']);
      } else if($params['dom_id'] == 'writer-list'){
        $this->displayAssignedWriters($params);
      }
    }

    /**
     * Displays project hours for this writer/editor
     *
     * @param mixed string $params
     * @param MongoId $writer_id
     * @access private
     */
    private function displayProjectHours($params, $writer_id = 0){
      $this->mongodb->switchCollection('projects');
      $hourList = array();
      if($writer_id != 0){
        $pipeline = array(
          $this->mongoGen->matchStage(array('_id' => new \MongoId($params['_id']), 'assigned_writers' => $writer_id)),
          $this->mongoGen->projectStage(array('_id' => 0, 'work_hours' => 1)),
          $this->mongoGen->unwindStage('$work_hours'),
          $this->mongoGen->matchStage(array('work_hours.writer_id' => $writer_id)),
          $this->mongoGen->sortStage(array('work_hours.date' => -1)),
        );
        $hourList = $this->mongodb->aggregateDocs($pipeline);
        $hourList = $hourList['result'];
      }
      $exists = (count($hourList) > 0) ? 1 : 0;
      echo $this->twig->render('projects/project-hours.html', array('HOUR_LIST' => $hourList, 'HOUR_LIST_EXISTS' => $exists));
    }

    /**
     * Displays writers assigned to this project
     *
     * @param mixed string $params
     * @access private
     */
    private function displayAssignedWriters($params){
      $this->mongodb->switchCollection('projects');
      $writerList = array();
      if($params['_id'] != 0){
        $project = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('_id' => 0, 'assigned_writers' => 1));
        $this->mongodb->switchCollection('writers');
        $maxWriters = count($project['assigned_writers']);
        for($i = 0; $i < $maxWriters; $i++){
          $writerList[] = $this->mongodb->getDocument(array('_id' => $project['assigned_writers'][$i]), array('writer_name' => 1));
        }
      }
      $exists = (count($writerList) > 0) ? 1 : 0;
      echo $this->twig->render('projects/writer-list.html', array('WRITER_LIST' => $writerList, 'WRITER_LIST_EXISTS' => $exists));
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      if($params['doc']['set'] == 'work_hours'){
        $this->saveProjectHours($params);
      } else if($params['doc']['set'] == 'assigned_writers'){
        $params['doc']['values'] = new \MongoId($params['doc']['values']);
        parent::addSetToEntry($params);
      }
    }

    /**
     * Removes a set value from the doc in the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function removeSetFromEntry($params){
      if($params['doc']['set'] == 'work_hours'){
        parent::removeSetFromEntry($params);
      } else if($params['doc']['set'] == 'assigned_writers'){
        $params['doc']['values'] = new \MongoId($params['doc']['values']);
        parent::removeSetFromEntry($params);
      }
    }

    /**
     * Saves project hours to the project
     *
     * @param mixed array $params    
     * @access private
     */
    private function saveProjectHours($params){
      $result = null;
      $params['doc']['values']['work_id'] = ($params['doc']['values']['work_id'] == "") ? md5($this->generateRandomString().date('U')) : $params['doc']['values']['work_id']; 
      $params['doc']['values']['writer_id'] = $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'];
      $params['doc']['values']['hours'] = (float)$params['doc']['values']['hours'];
      $params['doc']['values']['date_added'] = date('m-d-Y h:ia', date('U')).' EST';
      $this->mongodb->switchCollection('projects');
      $exists = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id']), 'work_hours.work_id' => $params['doc']['values']['work_id']));
      if($exists){
        $setID = $params['doc']['values']['work_id'];
        foreach ($params['doc']['values'] as $k => $v){
          $params['doc']['values']['work_hours.$.'.$k] = $v;  
          unset($params['doc']['values'][$k]);
        }
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['_id']), 'work_hours.work_id' => $setID), $this->mongoGen->setOp($params['doc']['values']));
      } else {
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['_id'])), $this->mongoGen->addToSetOp('work_hours', $params['doc']['values']));
      }
      echo json_encode($result);
    }

    /**
     * Produces a randomized string
     *
     * @param int length - changes the length of the string
     * @return string
     * @access private
     */
    private function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
    }
  }
?>