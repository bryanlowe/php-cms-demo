<?php
  namespace Application\_backend\_admin\_pages\invoices;
  use Application\_backend\Backend as Backend;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;
  
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
  }
?>