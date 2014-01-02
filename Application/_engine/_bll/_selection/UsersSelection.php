<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\Selection as Selection;

  /**
   * Class: UsersSelection
   *    
   * Selects a database record from table users and treats it as an object
   */
  class UsersSelection extends Selection{
    public function __construct(){
      parent::__construct('users');
    }
  }
?>