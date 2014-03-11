<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  
  /**
   * Class: OrdersCollection
   *    
   * Collects a set database records from table orders and treats them as a collection of object
   */
  class OrdersCollection extends Collection{
    public function __construct(){
      parent::__construct('orders');
    }
  }
?>