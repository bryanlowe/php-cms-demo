<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  
  /**
   * Class: InvoiceStatusCollection
   *    
   * Collects a set database records from table invoice_status and treats them as a collection of object
   */
  class InvoiceStatusCollection extends Collection{
    public function __construct(){
      parent::__construct('invoice_status');
    }
  }
?>