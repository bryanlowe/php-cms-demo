<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: UserGroupCollection
   *    
   * Collects a set database records from table user_group and treats them as a collection of object
   */
  class UserGroupCollection extends Collection{
    public function __construct(){
      parent::__construct('user_group');
    }
  }
?>