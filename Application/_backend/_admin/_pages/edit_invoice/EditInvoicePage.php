<?php
  namespace Application\_backend\_admin\_pages\edit_invoice;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: EditInvoicePage
   *    
   * Handles the Edit Invoice Page
   */
  class EditInvoicePage extends Backend{

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
      $this->addJS('_admin/edit-invoice/scripts.min.js');
      $this->setTitle('CEM Dashboard - Edit Writer Invoice');
      $this->setTemplate('edit-invoice/main.html');
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
        $this->loadInvoice($params);
      } else if($params['dom_id'] == "invoices_select_container"){
        $this->updateInvoiceSelect($params);
      }
    }

    /**
     * Loads an invoice for a writer
     *
     * @param string array $params
     * @access private
     */
    private function loadInvoice($params){
      if($params['_id'] != 0){
        $this->mongodb->switchCollection('invoices');
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])));
        $this->mongodb->switchCollection('writers');
        $invoice['writer'] = $this->mongodb->getDocument(array('_id' => new \MongoId($invoice['writer_id'])));
        $maxTasks = count($invoice['task_list']);
        $this->mongodb->switchCollection('projects');
        $total_due = 0;
        for($i = 0; $i < $maxTasks; $i++){
          $total_due += (int)$invoice['task_list'][$i]['total_due'];
          $invoice['task_list'][$i]['total_due'] = number_format($invoice['task_list'][$i]['total_due'], 2, '.', ',');
          $invoice['task_list'][$i]['work_details'] = $this->mongodb->getDocument(array('_id' => new \MongoId($invoice['task_list'][$i]['project_id']), 'work_hours.work_id' => $invoice['task_list'][$i]['work_id']),array('_id' => 0, 'project_title' => 1, 'work_hours.$' => 1));
          $invoice['task_list'][$i]['work_details']['work_hours'] = (count($invoice['task_list'][$i]['work_details']['work_hours']) > 0) ? array_shift($invoice['task_list'][$i]['work_details']['work_hours']) : $invoice['task_list'][$i]['work_details']['work_hours'];
        }
        echo $this->twig->render('edit-invoice/invoice-entry.html', array('INVOICE_ENTRIES' => $invoice['task_list'], 'INVOICE_STATUS' => $invoice['invoice_status'], 'START_DATE' => $invoice['period_start'], 'END_DATE' => $invoice['period_end'], 'WRITER_RATE' => number_format($invoice['writer']['writer_rate'], 2, '.', ','),'TOTAL_DUE' => number_format($total_due, 2, '.', ',')));  
      } else {
        echo $this->twig->render('edit-invoice/invoice-entry.html', array());
      }
    }

    /**
     * Loads all writer invoices according to the toggle
     *
     * @param string array $params
     * @access private
     */
    private function updateInvoiceSelect($params){
      if($params['_id'] != 0){
        $this->mongodb->switchCollection('invoices');
        $invoices = $this->mongodb->getDocuments(array('writer_id' => new \MongoId($params['_id']), 'invoice_status' => $params['invoice_toggle']));
        $invoices = foo(new MongoAccessLayer('invoices'))->joinCollectionsByID($invoices, 'writers', 'writer_id'); 
        $maxInvoices = count($invoices);
        for($i = 0; $i < $maxInvoices; $i++){
          $invoices[$i]['date'] = date('m/d/Y', $invoices[$i]['invoice_date']);
        }
        if($maxInvoices > 0){
          echo $this->twig->render('edit-invoice/invoices_select.html', array('SELECT_INVOICES' => $invoices));  
        } else {
          echo $this->twig->render('edit-invoice/invoices_select.html', array());
        }
      } else {
        echo $this->twig->render('edit-invoice/invoices_select.html', array());
      }
    }

    /**
     * Removes a set value from the doc in the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function removeSetFromEntry($params){ 
      $this->mongodb->switchCollection('projects');
      $this->mongodb->updateDocument(array('work_hours.work_id' => $params['doc']['values']['work_id']), $this->mongoGen->unsetOp(array('work_hours.$.invoice_id' => '')));
      parent::removeSetFromEntry($params);   
    }

    /**
     * Deletes a doc from the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function deleteEntry($params){
      $this->mongodb->switchCollection('invoices');
      $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])));
      $this->mongodb->switchCollection('projects');
      $maxTasks = count($invoice['task_list']);
      for($i = 0; $i < $maxTasks; $i++){
        $this->mongodb->updateDocument(array('work_hours.work_id' => $invoice['task_list'][$i]['work_id']), $this->mongoGen->unsetOp(array('work_hours.$.invoice_id' => '')));
      }
      parent::deleteEntry($params);
    }
  }
?>