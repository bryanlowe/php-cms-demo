<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\Selection as Selection;

  /**
   * Class: ProjectsSelection
   *    
   * Selects a database record from table projects and treats it as an object
   */
  class ProjectsSelection extends Selection{
    public function __construct(){
      parent::__construct('projects');
    }
  }
?>