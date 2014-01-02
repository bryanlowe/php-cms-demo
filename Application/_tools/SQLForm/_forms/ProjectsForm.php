<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: ProjectsForm
   *    
   * Creates a Selection object based on projects, creates forms, saves and deletes database entries.
   */  
  class ProjectsForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('projects', $objectID);
    }
  }
?>