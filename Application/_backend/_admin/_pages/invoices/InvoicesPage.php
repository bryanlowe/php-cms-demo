<?php
  namespace Application\_backend\_admin\_pages\invoices;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  
  /**
   * Class: InvoicesPage
   *    
   * Handles the Invoice Management Page
   */
  class InvoicesPage extends Backend{

    /**
     * Client Select Pipeline - this is an aggregation pipeline of values that are needed for the client select drop down
     * 
     * mixed array
     * @access private
     */
    private $client_select_pipeline = array();

    /**
     * Invoice Select Pipeline - this is an aggregation pipeline of values that are needed for the invoice select drop down
     * 
     * mixed array
     * @access private
     */
    private $invoice_select_pipeline = array();

    /**
     * Construct a new InvoicesPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
      $this->client_select_pipeline = array(
        $this->mongoGen->projectStage(array("company" => 1, "client_name" => 1)),
        $this->mongoGen->sortStage(array("client_name" => 1, 'company' => 1))
      );
      $this->invoice_select_pipeline = array(
        $this->mongoGen->projectStage(array("invoice_number" => 1, "client_id" => 1)),
        $this->mongoGen->sortStage(array("client_id" => 1))
      );
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
      $this->addJS('_admin/invoices/scripts.js');
      $this->setTitle('CEM Dashboard - Invoice Management');
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
      $invoiceForm = foo(new FormGenerator($this->config->dir($this->source).'/invoices/invoices_form.json'))->getFormHTML();
      $this->setDisplayVariables('INVOICE_FORM', $invoiceForm);
      $results = $this->mongodb->aggregateDocs($this->invoice_select_pipeline);
      $select_invoices = foo(new MongoAccessLayer('invoices'))->joinCollectionsByID($results['result'], 'clients', 'client_id'); 
      $this->setDisplayVariables('SELECT_INVOICES', $select_invoices);
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients['result']);
      $timestamp = time();
      $this->setDisplayVariables('TIMESTAMP', $timestamp);
      $this->setDisplayVariables('UPLOAD_TOKEN', md5($this->config->passwords['uploads'] . $timestamp));
    }

    /**
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'invoices_select_container'){
        $this->mongodb->switchCollection('invoices');
        $results = $this->mongodb->aggregateDocs($this->invoice_select_pipeline);
        $select_projects = foo(new MongoAccessLayer('invoices'))->joinCollectionsByID($results['result'], 'clients', 'client_id');
        echo $this->twig->render('invoices/invoices_select.html', array('SELECT_INVOICES' => $select_projects));
      } else if($params['dom_id'] == 'clients_select_container'){
        $this->mongodb->switchCollection('clients');
        $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
        echo $this->twig->render('invoices/clients_select.html', array('SELECT_CLIENTS' => $select_clients['result']));
      } else if($params['dom_id'] == 'status-list'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('invoices');
          $result = $this->mongodb->getDocument(array("_id" => new \MongoId($params['_id'])),array("_id" => 0, "invoice_history" => 1));
          echo $this->twig->render('invoices/list-group-item.html', array('INVOICE_HISTORY' => $result['invoice_history']));
        } else {
          echo $this->twig->render('invoices/list-group-item.html', array('INVOICE_HISTORY' => array()));
        }
      }
    }

    /**
     * Saves the form entry to the database
     *
     * @param mixed array $params
     * @access public
     */
    public function saveEntry($params){
      if(isset($params['doc']['values']['client_id'])){
        $params['doc']['values']['client_id'] = new \MongoId($params['doc']['values']['client_id']);
      }
      parent::saveEntry($params);
    }

    /**
     * Deletes a doc from the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function deleteEntry($params){
      if($this->isAdminUser()){
        $this->mongodb->switchCollection('invoices');
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['_id'])),array("_id" => 0,"invoice_filename" => 1));   
        $filename = $invoice['invoice_filename'];
        $invoice['invoice_filename'] = '';
        $result = foo(new MongoAccessLayer('invoices'))->saveDocEntry($invoice, $params['doc']['_id']);
        if($result['err'] == null && $filename != ''){
          unlink($this->config->root.'/Media/_documents/_invoices/'.$filename);
        }
        parent::deleteEntry($params);
      }
    }

    /**
     * Saves a set to an existing doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function addSetToEntry($params){
      $params['doc']['values']['date'] = date("m-d-Y H:i:s");
      parent::addSetToEntry($params);
    }

    /**
     * Remove invoice file from the media archives
     *
     * @param assoc array $param
     * @access public
     */
    public function removeInvoiceFile($params){
      if($this->isAdminUser()){
        $this->mongodb->switchCollection('invoices');
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])),array("_id" => 0,"invoice_filename" => 1));   
        $filename = $invoice['invoice_filename'];
        $invoice['invoice_filename'] = '';
        $result = foo(new MongoAccessLayer('invoices'))->saveDocEntry($invoice, $params['_id']);
        if($result['err'] == null){
          if($filename != ''){
            unlink($this->config->root.'/Media/_documents/_invoices/'.$filename);
          }
          echo 'pass';
        } else {
          echo $result['err'];
        }
      }
    }
  }
?>