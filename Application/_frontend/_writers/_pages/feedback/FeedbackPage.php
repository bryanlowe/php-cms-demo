<?php
  namespace Application\_frontend\_writers\_pages\feedback;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
    
  /**
   * Class: FeedbackPage
   *    
   * Handles the Feedback Page
   */
  class FeedbackPage extends Frontend{
    /**
     * Construct a new FeedbackPage object
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
    }
    
    /**
     * Initialize FeedbackPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_writers/feedback/scripts.min.js');
      $this->setTitle('CEM Dashboard - Writer Feedback');
      $this->setTemplate('feedback/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $feedbackForm = foo(new FormGenerator($this->config->dir($this->source).'/feedback/feedback_form.json'))->getFormHTML();
      $this->setDisplayVariables('FEEDBACK_FORM', $feedbackForm);
      $this->mongodb->switchCollection('projects');
      $pipeline = array(
        $this->mongoGen->matchStage(array('$or' => array(array('invoiced' => 0), $this->mongoGen->inequalityOp('project_date',(string)strtotime('-1 month'),MongoGenerator::COMPARE_GTE)))),
        $this->mongoGen->projectStage(array("project_title" => 1, "project_date" => 1)),
        $this->mongoGen->sortStage(array("project_date" => -1))
      );
      $projects = $this->mongodb->aggregateDocs($pipeline);
      $this->setDisplayVariables('PROJECTS', $projects['result']);
      $this->mongodb->switchCollection('feedback');
      $query = $this->mongoGen->logicOp(array(array('writer_id' => new \MongoId($_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'])), $this->mongoGen->inequalityOp('date',(string)strtotime('-1 month'),MongoGenerator::COMPARE_GTE)),MongoGenerator::LOGICAL_AND);
      $pipeline = array(
        $this->mongoGen->matchStage($query),
        $this->mongoGen->projectStage(array("project_id" => 1, "date" => 1, "description" => 1, "rating" => 1, "words_per_hour" => 1)),
        $this->mongoGen->sortStage(array("date" => -1))
      );
      $feedback = $this->mongodb->aggregateDocs($pipeline);
      $feedback = foo(new MongoAccessLayer('projects'))->joinCollectionsByID($feedback['result'], 'projects', 'project_id'); 
      $maxResults = count($feedback);
      for($i = 0; $i < $maxResults; $i++){
        $feedback[$i]['date'] = date('m-d-Y h:ia', $feedback[$i]['date']).' EST';
      }
      $this->setDisplayVariables('FEEDBACK_ENTRIES', $feedback);
      $this->setDisplayVariables('WRITER_TYPE', $_SESSION[$this->config->sessionID]['WRITER_INFO']['writer_type']);
    }

    /**
     * Reloads the dom elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'writers_select_container'){
        $this->refreshWriterDropDown($params);
      }
    }

    /**
     * Gathers writers from the database to refresh the dom drop down.
     *
     * @param string array $params    
     * @access private
     */
    private function refreshWriterDropDown($params){
      if($params['_id'] != 0){
        $this->mongodb->switchCollection('projects');
        $project = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('_id' => 0, 'work_hours.writer_id' => 1));
        $temp = array();
        $maxProjects = count($project['work_hours']);
        for($i = 0; $i < $maxProjects; $i++){
          if($project['work_hours'][$i]['writer_id'] != $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id']){
            $temp[] = $project['work_hours'][$i]['writer_id'];
          }
        }
        $writers = array();
        if(count($temp) > 0){
          $this->mongodb->switchCollection('writers');
          $writers = $this->mongodb->getDocuments($this->mongoGen->inequalityOp('_id',$temp,MongoGenerator::COMPARE_IN), array('writer_name' => 1));
        }
        echo $this->twig->render('feedback/writers_select.html', array('SELECT_WRITERS' => $writers));
      } else {
        echo $this->twig->render('feedback/writers_select.html', array('SELECT_WRITERS' => array()));
      }
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      $params['doc']['_id'] = '';
      $params['doc']['collection'] = "feedback";
      $params['doc']['values']['editor_id'] = $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'];
      $params['doc']['values']['writer_id'] = new \MongoId($params['doc']['writer_id']);
      $params['doc']['values']['project_id'] = new \MongoId($params['doc']['project_id']);
      $params['doc']['values']['date'] = date("U");
      $params['doc']['values']['read'] = 0;
      $params['doc']['values']['rating'] = (int) $params['doc']['values']['rating'];
      $params['doc']['values']['words_per_hour'] = (int) $params['doc']['values']['words_per_hour'];
      $params['doc']['values']['type'] = 'project';
      parent::saveEntry($params);
    }
  }
?>