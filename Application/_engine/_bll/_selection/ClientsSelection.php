<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: ClientsSelection
   *    
   * Selects a database record from table clients and treats it as an object
   */
  class ClientsSelection extends Selection{
    public function __construct(){
      parent::__construct('clients');
    }
  }
?>