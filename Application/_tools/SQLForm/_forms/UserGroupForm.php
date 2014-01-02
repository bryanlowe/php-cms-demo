<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: UserGroupForm
   *    
   * Creates a Selection object based on user_group, creates forms, saves and deletes database entries.
   */  
  class UserGroupForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('user_group', $objectID);
    }
  }
?>