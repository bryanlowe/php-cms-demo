<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\Selection as Selection;

  /**
   * Class: InvoiceFilesSelection
   *    
   * Selects a database record from table invoice_files and treats it as an object
   */
  class InvoiceFilesSelection extends Selection{
    public function __construct(){
      parent::__construct('invoice_files');
    }
  }
?>