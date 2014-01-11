<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: InvoiceFilesForm
   *    
   * Creates a Selection object based on invoice_files, creates forms, saves and deletes database entries.
   */  
  class InvoiceFilesForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('invoice_files', $objectID);
    }
  }
?>