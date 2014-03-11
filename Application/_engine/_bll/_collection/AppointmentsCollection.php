<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  
  /**
   * Class: AppointmentsCollection
   *    
   * Collects a set database records from table appointments and treats them as a collection of object
   */
  class AppointmentsCollection extends Collection{
    public function __construct(){
      parent::__construct('appointments');
    }
  }
?>