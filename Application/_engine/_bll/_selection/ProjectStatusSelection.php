<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\Selection as Selection;

  /**
   * Class: ProjectStatusSelection
   *    
   * Selects a database record from table project_status and treats it as an object
   */
  class ProjectStatusSelection extends Selection{
    public function __construct(){
      parent::__construct('project_status');
    }
  }
?>