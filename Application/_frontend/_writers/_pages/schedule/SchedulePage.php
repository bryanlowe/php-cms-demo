<?php
  namespace Application\_frontend\_writers\_pages\schedule;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: SchedulePage
   *    
   * Handles the Schedule Page
   */
  class SchedulePage extends Frontend{

    /**
     * Construct a new WritersPage object
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
      $this->addJS('_writers/schedule/scripts.min.js');
      $this->setTitle('CEM Writer Dashboard - Schedule');
      $this->setTemplate('schedule/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->setDisplayVariables('NEXT_MONDAY', date('Y-m-d', strtotime("next Monday")));
    }

    /**
     * Gathers the schedules from all writers
     *
     * @param string array $params
     * @access public
     */
    public function gatherScheduledEvents($params){
      $this->mongodb->switchCollection('writers');
      $writer = $this->mongodb->getDocument(array('_id' => $_SESSION[$this->config->sessionID]['WRITER_INFO']['_id']), array('_id' => 0,'schedule' => 1));
      $schedule = $writer['schedule'];
      echo json_encode($schedule);
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      $writer_id = (string)$_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'];
      $result = null;
      $params['doc']['values']['id'] = $writer_id.'_'.date("m_d_Y",strtotime($params['doc']['values']['start'])); 
      $params['doc']['values']['title'] = $_SESSION[$this->config->sessionID]['WRITER_INFO']['writer_name'] . $params['doc']['values']['title'];
      $this->mongodb->switchCollection('writers');
      $this->mongodb->updateDocument(array('_id' => new \MongoId($writer_id)), $this->mongoGen->pullOp('schedule', array('start' => array('$lt' => date('m/d/Y', strtotime('last Monday'))))));
      $exists = $this->mongodb->getCount(array('_id' => new \MongoId($writer_id), 'schedule.id' => $params['doc']['values']['id']));
      if($exists){
        $setID = $params['doc']['values']['id'];
        foreach ($params['doc']['values'] as $k => $v){
          $params['doc']['values']['schedule.$.'.$k] = $v;  
          unset($params['doc']['values'][$k]);
        }
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($writer_id), 'schedule.id' => $setID), $this->mongoGen->setOp($params['doc']['values']));
      } else {
        $result = $this->mongodb->updateDocument(array('_id' => new \MongoId($writer_id)), $this->mongoGen->addToSetOp('schedule', $params['doc']['values']));
      }
      echo json_encode($result);
    }
  }
?>