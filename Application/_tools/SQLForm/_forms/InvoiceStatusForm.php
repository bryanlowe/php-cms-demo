<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: InvoiceStatusForm
   *    
   * Creates a Selection object based on invoice_status, creates forms, saves and deletes database entries.
   */  
  class InvoiceStatusForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('invoice_status', $objectID);
    }
  }
?>