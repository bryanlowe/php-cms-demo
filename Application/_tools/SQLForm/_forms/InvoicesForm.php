<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

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