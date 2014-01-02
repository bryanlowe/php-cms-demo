<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\Selection as Selection;

  /**
   * Class: AppointmentsSelection
   *    
   * Selects a database record from table appointments and treats it as an object
   */
  class AppointmentsSelection extends Selection{
    public function __construct(){
      parent::__construct('appointments');
    }
  }
?>