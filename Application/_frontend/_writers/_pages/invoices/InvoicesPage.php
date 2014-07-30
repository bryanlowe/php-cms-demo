<?php
  namespace Application\_frontend\_writers\_pages\invoices;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_widgets\FileRender\_engine\_core\FileRender as FileRender;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: InvoicesPage
   *    
   * Handles the Invoices Page
   */
  class InvoicesPage extends Frontend{
    /**
     * Construct a new InvoicesPage object
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
     * Initialize InvoicesPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_writers/invoices/scripts.min.js');
      $this->setTitle('CEM Dashboard - View Invoice History');
      $this->setTemplate('invoices/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('invoices');
      $result =  $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('writer_id' => new \MongoId($_SESSION[$this->config->sessionID]['WRITER_INFO']['_id']))),$this->mongoGen->sortStage(array("invoice_date" => -1))));
      $invoice_entries = $result['result'];
      $maxResults = count($invoice_entries);
      for($i = 0; $i < $maxResults; $i++){
        $invoice_entries[$i]['invoice_date'] = date('m-d-Y h:ia', $invoice_entries[$i]['invoice_date']).' EST';
        $invoice_entries[$i]['invoice_cost'] = number_format($invoice_entries[$i]['invoice_cost'], 2, '.', ',');
      }
      $this->setDisplayVariables('INVOICE_ENTRIES', $invoice_entries);
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
        $query = $this->mongoGen->logicOp(array(array('writer_id' => new \MongoId($_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'])),$this->mongoGen->inequalityOp('invoice_date',(string)strtotime('1/1/'.date('Y')),MongoGenerator::COMPARE_GTE),$this->mongoGen->inequalityOp('invoice_date',(string)strtotime('1/1/'.(((int)date('Y'))+1)),MongoGenerator::COMPARE_LT)),MongoGenerator::LOGICAL_AND);
        $pipeline = array(
          $this->mongoGen->projectStage(array("_id" => 0, "writer_id" => 1, "invoice_date" => 1, "invoice_cost" => 1, "invoice_status" => 1)),
          $this->mongoGen->matchStage($query),
          $this->mongoGen->groupStage(array('_id' => '$invoice_status', 'total_cost' => array('$sum' => '$invoice_cost')))
        );
        $totals = $this->mongodb->aggregateDocs($pipeline);
        $totalPending = 0;
        $totalPaid = 0;
        for($i = 0; $i < count($totals['result']); $i++){
          if($totals['result'][$i]['_id'] == 'PAID'){
            $totalPaid = $totals['result'][$i]['total_cost'];
          } else {
            $totalPending = $totals['result'][$i]['total_cost'];
          }
        }
        $maxTasks = count($invoice['task_list']);
        $this->mongodb->switchCollection('projects');
        $total_due = 0;
        for($i = 0; $i < $maxTasks; $i++){
          $total_due += (int)$invoice['task_list'][$i]['total_due'];
          $invoice['task_list'][$i]['total_due'] = number_format($invoice['task_list'][$i]['total_due'], 2, '.', ',');
          $invoice['task_list'][$i]['work_details'] = $this->mongodb->getDocument(array('_id' => new \MongoId($invoice['task_list'][$i]['project_id']), 'work_hours.work_id' => $invoice['task_list'][$i]['work_id']),array('_id' => 0, 'project_title' => 1, 'work_hours.$' => 1));
          $invoice['task_list'][$i]['work_details']['work_hours'] = (count($invoice['task_list'][$i]['work_details']['work_hours']) > 0) ? array_shift($invoice['task_list'][$i]['work_details']['work_hours']) : $invoice['task_list'][$i]['work_details']['work_hours'];
        }
        echo $this->twig->render('invoices/invoice-details.html', array('INVOICE_DETAILS' => $invoice['task_list'], 'INVOICE_STATUS' => $invoice['invoice_status'], 'START_DATE' => $invoice['period_start'], 'END_DATE' => $invoice['period_end'], 'TOTAL_DUE' => number_format($total_due, 2, '.', ','), 'TOTAL_PENDING' => number_format($totalPending, 2, '.', ','), 'TOTAL_PAID' => number_format($totalPaid, 2, '.', ',')));  
      } else {
        echo $this->twig->render('invoices/invoice-details.html', array());
      }
    }

    /**
     * Saves the invoice pay period to a file
     *
     * @param string array $params
     * @access public
     */
    public function openInvoicePDF($params){
      if($params['_id'] != 0){
        $html = "";
        $savePath = $this->config->root."/Media/_documents/_invoices/_writers/".$_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'];
        $viewPath = "/Media/_documents/_invoices/_writers/".$_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'];
        if(!file_exists($savePath)){
          mkdir($savePath, 0755, true);
        }
        $this->mongodb->switchCollection('invoices');
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])));
        $query = $this->mongoGen->logicOp(array(array('writer_id' => new \MongoId($_SESSION[$this->config->sessionID]['WRITER_INFO']['_id'])),$this->mongoGen->inequalityOp('invoice_date',(string)strtotime('1/1/'.date('Y')),MongoGenerator::COMPARE_GTE),$this->mongoGen->inequalityOp('invoice_date',(string)strtotime('1/1/'.(((int)date('Y'))+1)),MongoGenerator::COMPARE_LT)),MongoGenerator::LOGICAL_AND);
        $pipeline = array(
          $this->mongoGen->projectStage(array("_id" => 0, "writer_id" => 1, "invoice_date" => 1, "invoice_cost" => 1, "invoice_status" => 1)),
          $this->mongoGen->matchStage($query),
          $this->mongoGen->groupStage(array('_id' => '$invoice_status', 'total_cost' => array('$sum' => '$invoice_cost')))
        );
        $totals = $this->mongodb->aggregateDocs($pipeline);
        $totalPending = 0;
        $totalPaid = 0;
        for($i = 0; $i < count($totals['result']); $i++){
          if($totals['result'][$i]['_id'] == 'PAID'){
            $totalPaid = $totals['result'][$i]['total_cost'];
          } else {
            $totalPending = $totals['result'][$i]['total_cost'];
          }
        }
        $maxTasks = count($invoice['task_list']);
        $this->mongodb->switchCollection('projects');
        $total_due = 0;
        for($i = 0; $i < $maxTasks; $i++){
          $invoice['task_list'][$i]['total_due'] = number_format($invoice['task_list'][$i]['total_due'], 2, '.', ',');
          $invoice['task_list'][$i]['work_details'] = $this->mongodb->getDocument(array('_id' => new \MongoId($invoice['task_list'][$i]['project_id']), 'work_hours.work_id' => $invoice['task_list'][$i]['work_id']),array('_id' => 0, 'project_title' => 1, 'work_hours.$' => 1));
          $invoice['task_list'][$i]['work_details']['work_hours'] = (count($invoice['task_list'][$i]['work_details']['work_hours']) > 0) ? array_shift($invoice['task_list'][$i]['work_details']['work_hours']) : $invoice['task_list'][$i]['work_details']['work_hours'];
        }
        $html = $this->twig->render('invoices/invoice-pdf.html', array('INVOICE_DETAILS' => $invoice['task_list'], 'INVOICE_STATUS' => $invoice['invoice_status'], 'START_DATE' => $invoice['period_start'], 'END_DATE' => $invoice['period_end'], 'TOTAL_DUE' => number_format($invoice['invoice_cost'], 2, '.', ','), 'TOTAL_PENDING' => number_format($totalPending, 2, '.', ','), 'TOTAL_PAID' => number_format($totalPaid, 2, '.', ',')));  
        $filename = "/" .str_replace(' ', '_', $_SESSION[$this->config->sessionID]['WRITER_INFO']['writer_name'])."_".str_replace('/', '-', $invoice['period_start'])."_".str_replace('/', '-', $invoice['period_end'])."_".$invoice['invoice_status'].".pdf"; 
        $savePath .= $filename;
        $viewPath .= $filename;
        $result = foo(new FileRender($html, $savePath))->createPDF();
        if($result == 'complete'){
          echo json_encode(array('err' => null, 'file_path' => $viewPath));
        }
      } else {
        echo json_encode(array('err' => 'No invoice ID provided.'));
      }
    }
  }
?>