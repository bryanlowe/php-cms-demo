<?php
  namespace Application\_frontend\_clients\_pages\invoices;
  use Application\_frontend\Frontend as Frontend;
  use Application\_engine\_bll\_collection\InvoicesCollection as InvoicesCollection;
  use Application\_engine\_bll\_collection\InvoiceStatusCollection as InvoiceStatusCollection;
  use Application\_engine\_bll\_collection\InvoiceFilesCollection as InvoiceFilesCollection;
  
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
      parent::__construct();
      $this->source = "client-templates";
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
    }
    
    /**
     * Set InvoicesPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('invoices/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $this->setDisplayVariables('INVOICE_ENTRIES', $this->getInvoiceRecords(), 'BODY');
    }

    /**
     * Get recent invoices
     *    
     * @access private
     */
    private function getInvoiceRecords(){
      $invoiceEntry = file_get_contents($this->config->dir('client-templates') . '/invoices/invoice-entry.html');
      $resultStr = "";
      $records = foo(new InvoicesCollection())->getByQuery('client_id = '.$this->db->quote($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id']));
      if(($maxRecords = count($records)) > 0){
        for($i = 0; $i < $maxRecords; $i++){
          $total_cost = '$'.number_format($records[$i]['total_cost'], 2, '.', ',');
          $status = foo(new InvoiceStatusCollection())->getByQuery('invoice_id = '.$this->db->quote($records[$i]['invoice_id']));
          $status = array_shift($status);
          $file = foo(new InvoiceFilesCollection())->getByQuery('invoice_id = '.$this->db->quote($records[$i]['invoice_id']));
          $file = array_shift($file);
          $statusDesc = "No status has been reported at this time.";
          $statusDate = "N/A";
          $filename = "N/A";
          $target = "";
          $fileLink = "#";
          if(count($status) > 0){
            $statusDesc = ($status['description'] != "" && isset($status['description'])) ? $status['description'] : $statusDesc;
            $statusDate = date("Y-m-d H:i:s", strtotime($status['invoice_status_date']));
          }
          if(count($file) > 0){
            $filename = $file['invoice_filename'];
            $target = "_blank";
            $fileLink = "/Media/_documents/_invoices/".$filename;
          }
          $resultStr .= str_replace(array("<!--///INVOICE_ID///-->","<!--///INVOICE_NUMBER///-->","<!--///INVOICE_UPDATE_DATE///-->","<!--///INVOICE_DESC///-->","<!--///INVOICE_STATUS///-->","<!--///LINK_HREF///-->","<!--///LINK_TARGET///-->","<!--///INVOICE_FILE///-->","<!--///INVOICE_COST///-->"), array($records[$i]['invoice_id'],$records[$i]['invoice_number'],$statusDate,$records[$i]['description'],$statusDesc,$fileLink,$target,$filename,$total_cost), $invoiceEntry);
        } 
      } else {
        $resultStr .= '<tr><td colspan="4"><p align="center">There are no active invoices to show.</p></td></tr>';
      }
      return $resultStr;
    }
  }
?>