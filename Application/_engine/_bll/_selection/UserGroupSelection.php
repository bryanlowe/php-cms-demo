<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: UserGroupSelection
   *    
   * Selects a database record from table user_group and treats it as an object
   */
  class UserGroupSelection extends Selection{
    public function __construct(){
      parent::__construct('user_group');
    }
  }
?>