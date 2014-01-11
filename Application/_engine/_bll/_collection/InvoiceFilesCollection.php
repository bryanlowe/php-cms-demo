<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\Collection as Collection;
  
  /**
   * Class: InvoiceFilesCollection
   *    
   * Collects a set database records from table invoice_files and treats them as a collection of object
   */
  class InvoiceFilesCollection extends Collection{
    public function __construct(){
      parent::__construct('invoice_files');
    }
  }
?>