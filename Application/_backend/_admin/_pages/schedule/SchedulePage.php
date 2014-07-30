<?php
  namespace Application\_backend\_admin\_pages\schedule;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: SchedulePage
   *    
   * Handles the Schedule Page
   */
  class SchedulePage extends Backend{

    /**
     * Writer Select Pipeline - this is an aggregation pipeline of values that are needed for the writer select drop down
     * 
     * mixed array
     * @access private
     */
    private $writer_select_pipeline = array();

    /**
     * Event Colors Array
     *
     * string array
     * @access private
     */
    private $writer_colors = array(
      array('color' => '#3A87AD', 'textColor' => '#ffffff'),
      array('color' => '#660099', 'textColor' => '#ffffff'),
      array('color' => '#330000', 'textColor' => '#ffffff'),
      array('color' => '#990066', 'textColor' => '#ffffff'),
      array('color' => '#CC0000', 'textColor' => '#ffffff'),
      array('color' => '#FF6600', 'textColor' => '#ffffff'),
      array('color' => '#04B431', 'textColor' => '#ffffff'),
      array('color' => '#9AFE2E', 'textColor' => '#ffffff'),
      array('color' => '#FA5882', 'textColor' => '#ffffff'),
      array('color' => '#01DFD7', 'textColor' => '#ffffff'),
      array('color' => '#2EFE9A', 'textColor' => '#ffffff'),
      array('color' => '#FE2E64', 'textColor' => '#ffffff'),
      array('color' => '#6E6E6E', 'textColor' => '#ffffff'),
      array('color' => '#FF0000', 'textColor' => '#ffffff'),
      array('color' => '#FAAC58', 'textColor' => '#ffffff'),
      array('color' => '#FFFF00', 'textColor' => '#ffffff'),
      array('color' => '#3104B4', 'textColor' => '#ffffff'),
      array('color' => '#8000FF', 'textColor' => '#ffffff'),
      array('color' => '#3A2F0B', 'textColor' => '#ffffff'),
      array('color' => '#000000', 'textColor' => '#ffffff')
    );

    /**
     * Construct a new WritersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
      $this->writer_select_pipeline = array(
        $this->mongoGen->matchStage(array("is_user" => 1)),
        $this->mongoGen->projectStage(array("writer_name" => 1)),
        $this->mongoGen->sortStage(array("writer_name" => 1))
      );
    }
    
    /**
     * Initialize WritersPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_widgets/_fullCal/fullcalendar.css');
      $this->addCSS('_widgets/_jquery_ui/ui-darkness/jquery-ui-1.10.4.custom.min.css');
      $this->addJS('_widgets/_fullCal/lib/moment.min.js');
      $this->addJS('_widgets/_jquery_ui/jquery-ui-1.10.4.custom.min.js');
      $this->addJS('_widgets/_fullCal/fullcalendar.min.js');
      $this->addJS('_admin/schedule/scripts.min.js');
      $this->setTitle('CEM Dashboard - Writer Schedule');
      $this->setTemplate('schedule/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('writers');
      $select_writers = $this->mongodb->aggregateDocs($this->writer_select_pipeline);
      $this->setDisplayVariables('SELECT_WRITERS', $select_writers['result']);
    }

    /**
     * Gathers the schedules from all writers
     *
     * @param string array $params
     * @access public
     */
    public function gatherScheduledEvents($params){
      if($params['_id'] == null || $params['_id'] == ""){
        $pipeline = array(
          $this->mongoGen->matchStage(array("is_user" => 1)),
          $this->mongoGen->projectStage(array("_id" => 0,"schedule" => 1))
        );
        $this->mongodb->switchCollection('writers');
        $writer_schedules = $this->mongodb->aggregateDocs($pipeline);
        $schedule = array();
        $maxResults = count($writer_schedules['result']);
        for($i = 0; $i < $maxResults; $i++){
          $schedule = array_merge($schedule, $writer_schedules['result'][$i]['schedule']);
        }
        $schedule = $this->addColorCode($schedule);
        echo json_encode($schedule);
      } else {
        $this->mongodb->switchCollection('writers');
        $writer_schedule = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('_id' => 0, 'schedule' => 1));
        echo json_encode($writer_schedule['schedule']);
      }
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      $result = null;
      $params['doc']['values']['id'] = $params['doc']['_id'].'_'.date("m_d_Y",strtotime($params['doc']['values']['start'])); 
      $this->mongodb->switchCollection('writers');
      $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['_id'])), $this->mongoGen->pullOp('schedule', array('start' => array('$lt' => date('m/d/Y', strtotime('last Monday'))))));
      $exists = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id']), 'schedule.id' => $params['doc']['values']['id']));
      if($exists){
        $setID = $params['doc']['values']['id'];
        foreach ($params['doc']['values'] as $k => $v){
          $params['doc']['values']['schedule.$.'.$k] = $v;  
          unset($params['doc']['values'][$k]);
        }
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['_id']), 'schedule.id' => $setID), $this->mongoGen->setOp($params['doc']['values']));
      } else {
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['_id'])), $this->mongoGen->addToSetOp('schedule', $params['doc']['values']));
      }
      echo json_encode($result);
    }

    /**
     * Add Colors to writers
     *
     * @param mixed array schedule
     * @access private
     */
    private function addColorCode($schedule){
      $current_id = '';
      $writer_id = '';
      $color_id = -1;
      $maxEvents = count($schedule);
      for($i = 0; $i < $maxEvents; $i++){
        if($writer_id == '' || substr_count($schedule[$i]['id'], $writer_id) == 0){
          $tempArr = explode('_', $schedule[$i]['id']);
          $writer_id = $tempArr[0];

        }
        if($writer_id != $current_id){
          $color_id++;
          $current_id = $writer_id;
        }
        $schedule[$i] = array_merge($schedule[$i], $this->writer_colors[$color_id]);
      }
      return $schedule;
    }
  }
?>