<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: OrdersSelection
   *    
   * Selects a database record from table orders and treats it as an object
   */
  class OrdersSelection extends Selection{
    public function __construct(){
      parent::__construct('orders');
    }
  }
?>