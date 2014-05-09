<?php
  namespace Application\_backend\_admin\_pages\orders;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;

  /**
   * Class: OrdersPage
   *    
   * Handles the Orders Page
   */
  class OrdersPage extends Backend{

    /**
     * Construct a new OrdersPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
    }
    
    /**
     * Initialize OrdersPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/orders/scripts.min.js');
      $this->setTitle('CEM Dashboard - Order Management');
      $this->setTemplate('orders/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('feedback');
      $recent_rst = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array("read" => 0, "type" => "order")), $this->mongoGen->sortStage(array("date" => -1))));
      $past_rst = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array("read" => 1, "type" => "order")), $this->mongoGen->sortStage(array("date" => -1))));
      $recent_posts = foo(new MongoAccessLayer('feedback'))->joinCollectionsByID($recent_rst['result'], 'clients', 'client_id');
      $past_posts = foo(new MongoAccessLayer('feedback'))->joinCollectionsByID($past_rst['result'], 'clients', 'client_id');
      $maxResults = count($recent_posts);
      for($i = 0; $i < $maxResults; $i++){
        $recent_posts[$i]['date'] = date('m-d-Y h:ia', $recent_posts[$i]['date']).' EST';
      }
      $this->setDisplayVariables('RECENT_ORDERS', $recent_posts);
      $this->setDisplayVariables('PAST_ORDERS', $past_posts);
    }

    /**
     * Creates a project from an order
     *
     * @param mixed array params
     * @access public
     */
    public function createProject($params){
      if($this->isAdminUser()){
        $this->mongodb->switchCollection('feedback');
        $order = $this->mongodb->getDocument(array('_id' => new \Mongoid($params['doc']['order_id'])));
        if($order != null){
          $project = array(
            'project_title' => $params['doc']['project_title'], 
            'project_description' => $order['description'],
            'project_tags' => $order['project_tags'],
            'client_id' => $order['client_id'],
            'invoiced' => 0,
            'project_date' => date("U"),
            'project_status' => 'Created'
          );
          $results = foo(new MongoAccessLayer('projects'))->saveDocEntry($project);
          echo json_encode($results);
        }
      }
    }

    /**
     * Mark a post as read
     *    
     * @param mixed array params
     * @access public
     */
    public function markAsRead($params){
      if($this->isAdminUser()){
        foo(new MongoAccessLayer('feedback'))->saveDocEntry(array('read' => 1), $params['_id']);
      }
    }

    /**
     * Delete a post
     *    
     * @param mixed array params
     * @access public
     */
    public function deletePost($params){
      if($this->isAdminUser()){
        foo(new MongoAccessLayer('feedback'))->deleteDocEntry($params['_id']);
      }
    }    
  }
?>