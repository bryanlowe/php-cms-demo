<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: ClientsForm
   *    
   * Creates a Selection object based on clients, creates forms, saves and deletes database entries.
   */  
  class ClientsForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('clients', $objectID);
    }
  }
?>