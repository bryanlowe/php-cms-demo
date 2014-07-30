<?php
  namespace Application\_backend\_admin\_pages\writers;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: WritersPage
   *    
   * Handles the Writers Page
   */
  class WritersPage extends Backend{

    /**
     * Writer Select Pipeline - this is an aggregation pipeline of values that are needed for the writer select drop down
     * 
     * mixed array
     * @access private
     */
    private $writer_select_pipeline = array();

    /**
     * Construct a new WritersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
      $this->writer_select_pipeline = array(
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
      $this->addCSS('_widgets/_jquery_ui/ui-darkness/jquery-ui-1.10.4.custom.min.css');
      $this->addJS('_widgets/_jquery_ui/jquery-ui-1.10.4.custom.min.js');
      $this->addJS('_admin/writers/scripts.min.js');
      $this->setTitle('CEM Dashboard - Writer Management');
      $this->setTemplate('writers/main.html');
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
      $opts = array('opt_in' => array('value' => '', 'options' => $this->gatherOptions()));
      $writerForm = foo(new FormGenerator($this->config->dir($this->source).'/writers/writers_form.json', $opts))->getFormHTML();
      $this->setDisplayVariables('WRITER_FORM', $writerForm);
    }

    /**
     * Reloads the dom elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'writers_select_container'){
        $this->mongodb->switchCollection('writers');
        $select_writers = $this->mongodb->aggregateDocs($this->writer_select_pipeline);
        echo $this->twig->render('writers/writers_select.html', array('SELECT_WRITERS' => $select_writers['result']));
      } else if($params['dom_id'] == 'opt-in-list'){
        $opt_ins = array();
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('writers');
          $result = $this->mongodb->getDocument(array("_id" => new \MongoId($params['_id'])),array("opt_in" => 1));
          if($result['opt_in'] != '' && count($result['opt_in']) > 0){
            $this->mongodb->switchCollection('opt_in');
            $inequality = $this->mongoGen->inequalityOp('_id',$result['opt_in'],MongoGenerator::COMPARE_IN);
            $exp = $this->mongoGen->logicOp(array($inequality, array('status' => '1')), MongoGenerator::LOGICAL_AND);
            $opt_ins = $this->mongodb->getDocuments($exp);
            $opt_ins = iterator_to_array($opt_ins);
            if(count($opt_ins) == 0){
              $opt_ins = array();
            }
          }
        }
        echo $this->twig->render('writers/list-group-item.html', array('OPT_INS' => $opt_ins));
      } else if($params['dom_id'] == 'writer-performance'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('feedback');
          $query = $this->mongoGen->logicOp(array(array('writer_id' => new \MongoId($params['_id'])), $this->mongoGen->inequalityOp('date',(string)strtotime('-1 month'),MongoGenerator::COMPARE_GTE)),MongoGenerator::LOGICAL_AND);
          $pipeline = array(
            $this->mongoGen->projectStage(array("writer_id" => 1, "date" => 1, "rating" => 1, "words_per_hour" => 1)),
            $this->mongoGen->matchStage($query),
            $this->mongoGen->groupStage(array('_id' => null, 'avg_rating' => array('$avg' => '$rating'), 'avg_wph' => array('$avg' => '$words_per_hour')))
          );
          $feedback = $this->mongodb->aggregateDocs($pipeline);
          echo $this->twig->render('writers/performance-entry.html', array('RATING' => $feedback['result'][0]['avg_rating'], 'WPH' => $feedback['result'][0]['avg_wph'], 'AS_OF_DATE' => date('m/d/Y', strtotime('-1 month'))));
        } else {
          echo $this->twig->render('writers/performance-entry.html', array('RATING' => "", 'WPH' => "", 'AS_OF_DATE' => ""));
        }
      } 
    }

    /**
     * Saves a doc to the database
     *
     * @access public
     */
    public function saveEntry($params){
      if($this->isAdminUser()){
        $duplicate = false;
        if($params['doc']['_id'] == ''){
          $params['doc']['values']['is_user'] = 0;
          $this->mongodb->switchCollection('writers');
          $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
          $writerCount = $this->mongodb->getCount(array('email' => $regexEmail));
          if($writerCount > 0){
            $duplicate = true;
          }
        } else {
          $this->mongodb->switchCollection('clients');
          $writer = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
          $regexEmail = new \MongoRegex("/^".$params['doc']['values']['email']."$/i"); 
          $writerCount = $this->mongodb->getCount(array('email' => $regexEmail));
          if($writerCount > 0 && strtolower($params['doc']['values']['email']) != strtolower($writer['email'])){
            $duplicate = true;
          }
          if(!$duplicate){
            $this->mongodb->switchCollection('users');
            if(($userCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
              $user = array(
                'type' => $params['doc']['values']['writer_type']
              );
              foo(new MongoAccessLayer('users'))->saveDocEntry($user, $params['doc']['_id']);
            }
          }
        }
        if(!$duplicate){
          $params['doc']['values']['writer_rate'] = (float)$params['doc']['values']['writer_rate'];
          $params['doc']['values']['pending_rate'] = ($params['doc']['values']['pending_rate'] != '') ? (float)$params['doc']['values']['pending_rate'] : '';
          $params['doc']['values']['pending_date'] = ($params['doc']['values']['pending_date'] != '') ? (int)strtotime($params['doc']['values']['pending_date']) : '';
          parent::saveEntry($params);  
        } else {
          echo json_encode(array('err' => 'This email already exists. Please use a different email.'));
        }  
      }
    }

    /**
     * Gathers options out of the database
     *
     * @access private
     * @return string array options
     */
    private function gatherOptions(){
      $options = array(array('name' => 'Select Opt-in', 'value' => ''));
      $this->mongodb->switchCollection('opt_in');
      $result = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('status' => '1')),$this->mongoGen->sortStage(array('title' => 1))));
      $maxOpts = count($result['result']);
      for($i = 0; $i < $maxOpts; $i++){
        $options[] = array('name' => $result['result'][$i]['title'], 'value' => (string)$result['result'][$i]['_id']); 
      }
      return $options;
    }

    /**
     * Gets the doc by _id
     *    
     * @param mixed array $params    
     * @access public
     */
    public function getEntry($params){
      if($this->isAdminUser()){
        $this->applyRateChange(new \MongoId($params['_id']));
        $results = foo(new MongoAccessLayer($params['collection']))->getDocByID($params['_id'], $params['mongoid']);
        if($results['pending_date'] != ""){
          $results['pending_rate'] = number_format($results['pending_rate'], 2, '.', ',');
          $results['pending_date'] = date('m/d/Y', $results['pending_date']);
        }
        $results['writer_rate'] = number_format($results['writer_rate'], 2, '.', ',');
        echo json_encode($results);
      }
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      $params['doc']['values'] = new \MongoId($params['doc']['values']);
      parent::addSetToEntry($params);
    }

    /**
     * Removes a set value from the doc in the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function removeSetFromEntry($params){
      $params['doc']['values'] = new \MongoId($params['doc']['values']);
      parent::removeSetFromEntry($params);
    }
  }
?>