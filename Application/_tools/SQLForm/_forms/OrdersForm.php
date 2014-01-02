<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: OrdersForm
   *    
   * Creates a Selection object based on orders, creates forms, saves and deletes database entries.
   */  
  class OrdersForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('orders', $objectID);
    }
  }
?>