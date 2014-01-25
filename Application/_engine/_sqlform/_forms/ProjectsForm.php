<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  use Application\_engine\_bll\_collection\ProjectStatusCollection as ProjectStatusCollection;

  /**
   * Class: ProjectsForm
   *    
   * Creates a Selection object based on projects, creates forms, saves and deletes database entries.
   */  
  class ProjectsForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('projects', $objectID);
    }

    /**   
     * Deletes the form entry from the table
     * First any statuses associated with the project
     *
     * @return string
     * @param string $primaryKey
     * @access public
     */
    public function delete($primaryKey){
      $projectStatus = foo(new ProjectStatusCollection())->getByQuery('project_id = '.$this->db->quote($primaryKey));
      $maxStatus = count($projectStatus);
      for($i = 0; $i < $maxStatus; $i++){
        if(($result = foo(new Form('project_status'))->delete($projectStatus[$i]['project_status_id'])) == 'Deletion Error'){
          return 'Error deleting project status from database. PrimaryID: '.$primaryKey.' Status ID: '.$projectStatus[$i]['project_status_id'];
        }
      }
      if(($result = parent::delete($primaryKey)) == "Deletion Error"){
        return 'Error Deleting Project. ProjectID: '.$primaryKey;
      }
      return $result;
    }
  }
?>