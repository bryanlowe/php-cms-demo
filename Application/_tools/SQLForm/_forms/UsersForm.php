<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: UsersForm
   *    
   * Creates a Selection object based on users, creates forms, saves and deletes database entries.
   */  
  class UsersForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('users', $objectID);
    }
  }
?>