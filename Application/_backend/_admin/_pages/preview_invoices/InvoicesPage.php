<?php
  namespace Application\_backend\_admin\_pages\preview_invoices;
  use Application\_backend\Backend as Backend;
  
  /**
   * Class: InvoicesPage
   *    
   * Handles the Invoices Page
   */
  class InvoicesPage extends Backend{
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
    }
    
    /**
     * Initialize InvoicesPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_admin/preview-invoices/scripts.min.js');
      $this->setTitle('CEM Dashboard - View Invoice History');
      $this->setTemplate('preview-invoices/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('clients');
      $select_clients = $this->mongodb->aggregateDocs($this->client_select_pipeline);
      $this->setDisplayVariables('SELECT_CLIENTS', $select_clients['result']);
    }

    /**
     * Reloads the invoice list
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'invoice_entries'){
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('invoices');
          $pipeline = array(
            $this->mongoGen->matchStage(array('client_id' => (new \MongoId($params['_id'])))),
            $this->mongoGen->sortStage(array('invoice_date' => -1))
          );
          $results = $this->mongodb->aggregateDocs($pipeline);
          $select_invoices = $results['result']; 
          $maxResults = count($select_invoices);
          $this->mongodb->switchCollection('projects');
          for($i = 0; $i < $maxResults; $i++){
            $select_invoices[$i]['invoice_date'] = date('m-d-Y h:ia', $select_invoices[$i]['invoice_date']).' EST';
            if(count($select_invoices[$i]['project_list']) > 0){
              $select_invoices[$i]['project_list'] = $this->mongodb->getDocuments(array('_id' => array('$in' => $select_invoices[$i]['project_list'])), array('_id' => 0,'project_title' => 1));  
            } else {
              $select_invoices[$i]['project_list'] = array();
            }
          }
          echo $this->twig->render('preview-invoices/invoice-entry.html', array('INVOICE_ENTRIES' => $select_invoices));        
        } else {
          echo $this->twig->render('preview-invoices/invoice-entry.html', array('INVOICE_ENTRIES' => array()));        
        }
      }
    }
  }
?>