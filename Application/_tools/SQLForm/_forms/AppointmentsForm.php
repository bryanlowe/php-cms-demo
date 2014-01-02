<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: AppointmentsForm
   *    
   * Creates a Selection object based on appointments, creates forms, saves and deletes database entries.
   */  
  class AppointmentsForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('appointments', $objectID);
    }
  }
?>