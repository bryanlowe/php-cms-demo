<?php
  namespace Application\_backend\_admin\_pages\invoices;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Collection as Collection;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: InvoicesPage
   *    
   * Handles the Invoice Management Page
   */
  class InvoicesPage extends Backend{

    /**
     * Construct a new InvoicesPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize InvoicesPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addCSS('_common/uploadify.css');
      $this->addJS('_common/jquery.uploadify.min.js');
      $this->setTitle('CEM Dashboard - Invoice Management');
    }

    /**
     * Set InvoicesPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set InvoicesPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('invoices/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $invoiceForm = foo(new Form('invoices'))->getFormHTML();
      $this->setDisplayVariables('INVOICE_FORM', $invoiceForm, 'BODY');
      $invoiceStatusForm = foo(new Form('invoice_status'))->getFormHTML();
      $this->setDisplayVariables('INVOICE_STATUS_FORM', $invoiceStatusForm, 'BODY');
      $invoiceFileForm = foo(new Form('invoice_files'))->getFormHTML();
      $this->setDisplayVariables('INVOICE_FILE_FORM', $invoiceFileForm, 'BODY');
      $timestamp = time();
      $this->setDisplayVariables('TIMESTAMP', $timestamp, 'BODY');
      $this->setDisplayVariables('UPLOAD_TOKEN', md5($this->config->passwords['uploads'] . $timestamp), 'BODY');
    } 

    /**
     * Set InvoicesPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('admin-templates') . '/invoices/scripts.html');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }   

    /**
     * Gets entries from the invoice status table by the invoice id
     *
     * @param assoc array $param
     * @access public
     */
    public function getInvoiceStatus($params){
      if($this->isAdminUser()){
        $where = "invoice_id = ".$this->db->quote($params['invoiceID']);
        echo json_encode(foo(new Collection('invoice_status'))->getByQuery($where));
      }
    }

    /**
     * Gets entries from the invoice file table by the invoice id
     *
     * @param assoc array $param
     * @access public
     */
    public function getInvoiceFile($params){
      if($this->isAdminUser()){
        $where = "invoice_id = ".$this->db->quote($params['invoiceID']);
        echo json_encode(foo(new Collection('invoice_files'))->getByQuery($where));
      }
    }

    /**
     * Remove invoice file from the media archives
     *
     * @param assoc array $param
     * @access public
     */
    public function removeInvoiceFile($params){
      if($this->isAdminUser()){
        unlink($this->config->root.'/Media/_documents/_invoices/'.$params['filename']);
      }
    }
  }
?>