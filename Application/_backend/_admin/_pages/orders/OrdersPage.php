<?php
  namespace Application\_backend\_admin\_pages\orders;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\OrdersCollection as OrdersCollection;

  /**
   * Class: OrdersPage
   *    
   * Handles the Orders Page
   */
  class OrdersPage extends Backend{
    /**
     * Order entry array
     *
     *@access private
     */
    private $orderEntries = array();

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
      $this->getOrderRecords(0);
      $this->setDisplayVariables('RECENT_ORDERS', $this->orderEntries);
      $this->getOrderRecords(1);
      $this->setDisplayVariables('PAST_ORDERS', $this->orderEntries);
    }

    /**
     * Get recent posts
     *    
     * int param read
     * @access private
     */
    private function getOrderRecords($read){
      $this->orderEntries = array();
      $records = foo(new OrdersCollection())->getByQuery('read_status = '.$this->db->quote($read), "order_date DESC");
      if(($maxRecords = count($records)) > 0){
        for($i = 0; $i < $maxRecords; $i++){
          $client = foo(new ClientsCollection())->getByQuery('client_id = '.$this->db->quote($records[$i]['client_id']));
          $clientName = "Anonymous";
          $company = "";
          if(count($client) > 0){
            $client = array_shift($client);
            $clientName = $client['client_name'];
            $company = '-- '.$client['company'];
          }
          $this->orderEntries[] = array('order_id' => $records[$i]['order_id'], 'read_status' => $records[$i]['read_status'], 'order_date' => $records[$i]['order_date'], 'order_details' => $records[$i]['description'], 'customer_name' => $clientName, 'company' => $company);
        } 
      } 
    }

    /**
     * Mark a post as read
     *    
     * mixed array params
     * @access public
     */
    public function markAsRead($params){
      if($this->isAdminUser()){
        $post = foo(new Selection('orders'))->getByID($params['orderID']);
        $post->assign(array('read_status' => 1));
        $post->save();
      }
    }    
  }
?>