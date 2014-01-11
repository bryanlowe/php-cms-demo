<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: ProjectStatusForm
   *    
   * Creates a Selection object based on project_status, creates forms, saves and deletes database entries.
   */  
  class ProjectStatusForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('project_status', $objectID);
    }
  }
?>