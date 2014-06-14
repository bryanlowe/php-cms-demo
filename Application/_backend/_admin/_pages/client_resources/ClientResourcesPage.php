<?php
  namespace Application\_backend\_admin\_pages\client_resources;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  
  /**
   * Class: ClientResourcesPage
   *    
   * Handles the Client Resource Page
   */
  class ClientResourcesPage extends Backend{

    /**
     * Client Select Pipeline - this is an aggregation pipeline of values that are needed for the client select drop down
     * 
     * mixed array
     * @access private
     */
    private $client_select_pipeline = array();

    /**
     * Construct a new ClientResourcesPage object
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
     * Initialize ClientsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/client-resources/scripts.min.js');
      $this->setTitle('CEM Dashboard - Client Resources');
      $this->setTemplate('client-resources/main.html');
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
     * Reloads the client select element
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      $resourceList = array();
      if($params['dom_id'] == 'resource-list' && $params['_id'] != 0){
        $this->mongodb->switchCollection('clients');
        $result = $this->mongodb->getCount(array("_id" => new \MongoId($params['_id'])));
        if($result > 0){
          $temp = array();
          if(file_exists($this->config->root.'/Media/_documents/_clients/'.$params['_id'])){
            $temp = scandir($this->config->root.'/Media/_documents/_clients/'.$params['_id']);
            $maxFiles = count($temp);
            for($i = 0; $i < $maxFiles; $i++){
              if($temp[$i] != '.' && $temp[$i] != '..'){
                $resourceList[] = $temp[$i];
              }
            }
          }
        }
      } 
      echo $this->twig->render('client-resources/list-group-item.html', array('RESOURCE_LIST' => $resourceList, 'CLIENT_ID' => $params['_id']));
    }

    /**
     * Remove client file from server
     *
     * @param string array $params
     * @access public
     */
    public function removeResource($params){
      $fileName = $this->config->root.'/Media/_documents/_clients/'.$params['_id'].'/'.$params['filename'];
      unlink($fileName);
    }
  }
?>