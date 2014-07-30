<?php
  namespace Application\_backend\_admin\_pages\create_invoice;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: CreateInvoicePage
   *    
   * Handles the Create Invoice Page
   */
  class CreateInvoicePage extends Backend{

    /**
     * Writer Select Pipeline - this is an aggregation pipeline of values that are needed for the writer select drop down
     * 
     * mixed array
     * @access private
     */
    private $writer_select_pipeline = array();

    /**
     * Construct a new CreateInvoicePage object
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
     * Initialize InvoicesPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addCSS('_widgets/_jquery_ui/ui-darkness/jquery-ui-1.10.4.custom.min.css');
      $this->addJS('_widgets/_jquery_ui/jquery-ui-1.10.4.custom.min.js');
      $this->addJS('_admin/create-invoice/scripts.min.js');
      $this->setTitle('CEM Dashboard - Create Writer Invoice');
      $this->setTemplate('create-invoice/main.html');
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
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == "writer-invoice"){
        $this->createInvoice($params);
      }
    }

    /**
     * Creates an invoice for a writer within the time period provided
     *
     * @param string array $params
     * @access private
     */
    private function createInvoice($params){
      if($params['_id'] != 0){
        $this->applyRateChange(new \MongoId($params['_id']));
        $this->mongodb->switchCollection('writers');
        $writer = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])));
        $query = $this->mongoGen->logicOp(array(array('work_hours.writer_id' => new \MongoId($params['_id'])), $this->mongoGen->inequalityOp('work_hours.date',$params['start_date'],MongoGenerator::COMPARE_GTE), $this->mongoGen->inequalityOp('work_hours.date',$params['end_date'],MongoGenerator::COMPARE_LTE), $this->mongoGen->existOp('work_hours.invoice_id', false)),MongoGenerator::LOGICAL_AND);
        $pipeline = array(
          $this->mongoGen->matchStage(array('work_hours.writer_id' => new \MongoId($params['_id']))),
          $this->mongoGen->unwindStage('$work_hours'),
          $this->mongoGen->matchStage($query),
          $this->mongoGen->projectStage(array('project_title' => 1,'work_hours.work_id' => 1,'work_hours.description' => 1,'work_hours.hours' => 1,'work_hours.date' => 1)),
          $this->mongoGen->sortStage(array('work_hours.date' => -1))
        );
        $this->mongodb->switchCollection('projects');   
        $results = $this->mongodb->aggregateDocs($pipeline);
        $maxResults = count($results['result']);
        $total_due = 0;
        for($i = 0; $i < $maxResults; $i++){
          $results['result'][$i]['total_pay'] = (int)$writer['writer_rate'] * (int)$results['result'][$i]['work_hours']['hours'];
          $total_due += $results['result'][$i]['total_pay'];
          $results['result'][$i]['total_pay'] = number_format($results['result'][$i]['total_pay'], 2, '.', ',');
        }
        if($maxResults > 0){
          echo $this->twig->render('create-invoice/invoice-entry.html', array('INVOICE_ENTRIES' => $results['result'], 'START_DATE' => $params['start_date'], 'END_DATE' => $params['end_date'], 'WRITER_RATE' => number_format($writer['writer_rate'], 2, '.', ','),'TOTAL_DUE' => number_format($total_due, 2, '.', ',')));  
        } else {
          echo $this->twig->render('create-invoice/invoice-entry.html', array());
        }
      } else {
        echo $this->twig->render('create-invoice/invoice-entry.html', array());
      }
    }

    /**
     * Saves the writer invoice to the database
     *
     * @param mixed array $params
     * @access public
     */
    public function saveInvoice($params){
      if($this->isAdminUser()){
        $params['doc']['values']['writer_id'] = new \MongoId($params['doc']['values']['writer_id']);
        $params['doc']['values']['invoice_date'] = date("U");
        $params['doc']['values']['invoice_cost'] = (float)str_replace(',','',$params['doc']['values']['invoice_cost']);
        $params['doc']['values']['_id'] = new \MongoId();
        $maxTasks = count($params['doc']['values']['task_list']);
        for($i = 0; $i < $maxTasks; $i++){
          $params['doc']['values']['task_list'][$i]['total_due'] = (float)str_replace(',', '', $params['doc']['values']['task_list'][$i]['total_due']);
        }
        $this->mongodb->switchCollection('invoices');
        $result = $this->mongodb->insertDocument($params['doc']['values']);
        if($results['err'] == null){
          $this->mongodb->switchCollection('projects');
          for($i = 0; $i < $maxTasks; $i++){
            $this->mongodb->updateDocument(array('_id' => new \MongoId($params['doc']['values']['task_list'][$i]['project_id']), 'work_hours.work_id' => $params['doc']['values']['task_list'][$i]['work_id']), $this->mongoGen->setOp(array('work_hours.$.invoice_id' => $params['doc']['values']['_id'])));
          }
        }  
      }  
      echo json_encode($result);
    }
  }
?>