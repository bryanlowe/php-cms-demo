<?php
  namespace Application\_frontend\_clients\_pages\invoices;
  use Application\_frontend\Frontend as Frontend;
  
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
      $this->source = "client-templates";
      parent::__construct();
    }
    
    /**
     * Initialize InvoicesPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_clients/invoices/scripts.min.js');
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
      $result =  $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array('client_id' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'])),$this->mongoGen->sortStage(array("invoice_date" => -1))));
      $invoice_entries = $result['result'];
      $maxResults = count($invoice_entries);
      $this->mongodb->switchCollection('projects');
      for($i = 0; $i < $maxResults; $i++){
        $invoice_entries[$i]['invoice_date'] = date('m-d-Y h:ia', $invoice_entries[$i]['invoice_date']).' EST';
        if(count($invoice_entries[$i]['project_list']) > 0){
          $invoice_entries[$i]['project_list'] = $this->mongodb->getDocuments(array('_id' => array('$in' => $invoice_entries[$i]['project_list'])), array('_id' => 0,'project_title' => 1));  
        } else {
          $invoice_entries[$i]['project_list'] = array();
        }
      }
      $this->setDisplayVariables('INVOICE_ENTRIES', $invoice_entries);
    }
  }
?>