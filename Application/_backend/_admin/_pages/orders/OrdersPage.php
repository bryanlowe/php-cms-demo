<?php
  namespace Application\_backend\_admin\_pages\orders;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Selection as Selection;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\OrdersCollection as OrdersCollection;

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
      parent::__construct();
      $this->source = "admin-templates";
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
    }

    /**
     * Set OrdersPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set OrdersPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('orders/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $recentOrders = $this->getOrderRecords(0);
      $this->setDisplayVariables('RECENT_ORDERS', $recentOrders, 'BODY');
      $pastOrders = $this->getOrderRecords(1);
      $this->setDisplayVariables('PAST_ORDERS', $pastOrders, 'BODY');
    }

    /**
     * Get recent posts
     *    
     * int param read
     * @access private
     */
    private function getOrderRecords($read){
      $listGroupItem = file_get_contents($this->config->dir('admin-templates') . '/orders/list-group-item.html');
      $resultStr = "";
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
          $resultStr .= str_replace(array("<!--///ORDER_ID///-->","<!--///READ_STATUS///-->","<!--///POST_DATE///-->","<!--///ORDER_DETAILS///-->","<!--///CUSTOMER_NAME///-->","<!--///COMPANY///-->"), array($records[$i]['order_id'],$records[$i]['read_status'],$records[$i]['order_date'],$records[$i]['description'],$clientName,$company), $listGroupItem);
        } 
      } else {
        $resultStr .= '<h2 class="no-entries" align="center">No orders to show</h2>';
      }
      return $resultStr;
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