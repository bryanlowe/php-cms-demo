<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: OrdersForm
   *    
   * Creates a Selection object based on orders, creates forms, saves and deletes database entries.
   */  
  class OrdersForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('orders', $objectID);
    }

    /**   
     * Saves the form inputs to the table
     *
     * @return string
     * @param mixed array $values
     * @access public
     */
    public function save($values){
      $values['order_date'] = date('Y-m-d h:i:s.u');
      return parent::save($values);
    }
  }
?>