<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: ProjectStatusCollection
   *    
   * Collects a set database records from table project_status and treats them as a collection of object
   */
  class ProjectStatusCollection extends Collection{
    public function __construct(){
      parent::__construct('project_status');
    }
  }
?>