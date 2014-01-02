<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: InvoicesCollection
   *    
   * Collects a set database records from table invoices and treats them as a collection of object
   */
  class InvoicesCollection extends Collection{
    public function __construct(){
      parent::__construct('invoices');
    }
  }
?>