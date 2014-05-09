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
      $this->addJS('_admin/invoices/scripts.min.js');
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
    }

    /**
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'invoices_select_container'){
        $this->refreshInvoiceSelect($params);
      } else if($params['dom_id'] == 'clients_select_container'){
        $this->refreshClientSelect($params);
      } else if($params['dom_id'] == 'projects_select_container'){
        $this->refreshProjectSelect($params);
      } else if($params['dom_id'] == 'toggleInvoice'){
        $this->refreshInvoiceStatus($params);
      } else if($params['dom_id'] == 'current_projects'){
        $this->refreshProjectList($params);
      } else if($params['dom_id'] == 'file_link'){
        $this->refreshInvoiceFileLink($params);
      }
    }

    /**
     * Refreshes the invoice select container
     *
     * @param string array $params
     * @access private
     */
    private function refreshInvoiceSelect($params){
      $this->mongodb->switchCollection('invoices');
      $results = $this->mongodb->aggregateDocs($this->invoice_select_pipeline);
      $select_invoices = foo(new MongoAccessLayer('invoices'))->joinCollectionsByID($results['result'], 'clients', 'client_id');
      echo $this->twig->render('invoices/invoices_select.html', array('SELECT_INVOICES' => $select_invoices));
    }

    /**
     * Refreshes the client select container
     *
     * @param string array $params
     * @access private
     */
    private function refreshClientSelect($params){
      $this->mongodb->switchCollection('clients');
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      echo $this->twig->render('invoices/clients_select.html', array('SELECT_CLIENTS' => $select_clients['result']));
    }

    /**
     * Refreshes the project select container
     *
     * @param string array $params
     * @access private
     */
    private function refreshProjectSelect($params){
      $this->mongodb->switchCollection('projects');
      if($params['_id'] != 0){
        $pipeline = array(
          $this->mongoGen->projectStage(array("project_title" => 1, "client_id" => 1, "project_date" => 1, 'invoiced' => 1)),
          $this->mongoGen->matchStage(array('client_id' => (new \MongoId($params['_id'])), 'invoiced' => 0)),
          $this->mongoGen->sortStage(array("project_date" => -1, "project_title" => 1))
        );
        $select_projects = $this->mongodb->aggregateDocs($pipeline);
        echo $this->twig->render('invoices/projects_select.html', array('SELECT_PROJECTS' => $select_projects['result']));
      } else {
        echo $this->twig->render('invoices/projects_select.html', array('SELECT_PROJECTS' => array()));
      }
    }

    /**
     * Refreshes the project list container
     *
     * @param string array $params
     * @access private
     */
    private function refreshProjectList($params){
      $this->mongodb->switchCollection('invoices');
      if($params['_id'] != 0){
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('project_list' => 1));
        $this->mongodb->switchCollection('projects');
        if(count($invoice['project_list']) > 0){
          $project_list = $this->mongodb->getDocuments(array('_id' => array('$in' => $invoice['project_list'])), array('project_title' => 1));
          echo $this->twig->render('invoices/current_projects.html', array('SELECT_PROJECTS' => $project_list));  
        } else {
          echo $this->twig->render('invoices/current_projects.html', array('SELECT_PROJECTS' => array()));
        }
      } else {
        echo $this->twig->render('invoices/current_projects.html', array('SELECT_PROJECTS' => array()));
      }
    }

    /**
     * Refreshes the invoice status
     *
     * @param string array $params
     * @access private
     */
    private function refreshInvoiceStatus($params){
      $this->mongodb->switchCollection('invoices');
      if($params['_id'] != 0){
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('invoice_status' => 1));
        echo $this->twig->render('invoices/invoice_status.html', array('INVOICE_STATUS' => $invoice['invoice_status']));
      } else {
        echo $this->twig->render('invoices/invoice_status.html', array('INVOICE_STATUS' => ''));
      }
    }

    /**
     * Refreshes the invoice file link
     *
     * @param string array $params
     * @access private
     */
    private function refreshInvoiceFileLink($params){
      $this->mongodb->switchCollection('invoices');
      if($params['_id'] != 0){
        $invoice = $this->mongodb->getDocument(array('_id' => new \MongoId($params['_id'])), array('invoice_filename' => 1));
        echo $this->twig->render('invoices/file_upload.html', array('SELECT_INVOICE' => $invoice));
      } else {
        echo $this->twig->render('invoices/file_upload.html', array('SELECT_INVOICE' => array()));
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
      $params['doc']['values']['invoice_date'] = date("U");
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
      $params['doc']['values'] = new \MongoId($params['doc']['values']);
      $this->mongodb->switchCollection('projects');
      $this->mongodb->updateDocument(array('_id' => $params['doc']['values']), $this->mongoGen->setOp(array('invoiced' => 1)));
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
      $this->mongodb->switchCollection('projects');
      $this->mongodb->updateDocument(array('_id' => $params['doc']['values']), $this->mongoGen->setOp(array('invoiced' => 0)));
      parent::removeSetFromEntry($params);   
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