<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: ProjectsCollection
   *    
   * Collects a set database records from table projects and treats them as a collection of object
   */
  class ProjectsCollection extends Collection{
    public function __construct(){
      parent::__construct('projects');
    }
  }
?>