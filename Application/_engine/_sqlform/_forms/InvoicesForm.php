<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: InvoicesForm
   *    
   * Creates a Selection object based on invoices, creates forms, saves and deletes database entries.
   */  
  class InvoicesForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('invoices', $objectID);
    }
  }
?>