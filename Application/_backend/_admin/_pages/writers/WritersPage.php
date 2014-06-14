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
      $this->addJS('_admin/writers/scripts.js');
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
          $this->mongodb->switchCollection('opt_in');
          $inequality = $this->mongoGen->inequalityOp('_id',$result['opt_in'],MongoGenerator::COMPARE_IN);
          $exp = $this->mongoGen->logicOp(array($inequality, array('status' => '1')), MongoGenerator::LOGICAL_AND);
          $opt_ins = $this->mongodb->getDocuments($exp);
          $opt_ins = iterator_to_array($opt_ins);
          if(count($opt_ins) == 0){
            $opt_ins = array();
          }
        }
        echo $this->twig->render('writers/list-group-item.html', array('OPT_INS' => $opt_ins));
      } 
    }

    /**
     * Saves a doc to the database
     *
     * @access public
     */
    public function saveEntry($params){
      if($this->isAdminUser()){
        if($params['doc']['_id'] == ''){
          $params['doc']['values']['is_user'] = 0;
        } else {
          $this->mongodb->switchCollection('users');
          if(($userCount = $this->mongodb->getCount(array('_id' => new \MongoId($params['doc']['_id'])))) == 1){
            $user = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])), array('_id' => 0));
            $user['type'] = $params['doc']['values']['writer_type'];
            foo(new MongoAccessLayer('users'))->saveDocEntry($user, $params['doc']['_id']);
          }
        }
        parent::saveEntry($params);  
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