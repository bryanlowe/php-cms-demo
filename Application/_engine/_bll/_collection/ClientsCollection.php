<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: ClientsCollection
   *    
   * Collects a set database records from table clients and treats them as a collection of object
   */
  class ClientsCollection extends Collection{
    public function __construct(){
      parent::__construct('clients');
    }
  }
?>