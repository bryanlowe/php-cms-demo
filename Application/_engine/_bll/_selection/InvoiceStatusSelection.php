<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: InvoiceStatusSelection
   *    
   * Selects a database record from table invoice_status and treats it as an object
   */
  class InvoiceStatusSelection extends Selection{
    public function __construct(){
      parent::__construct('invoice_status');
    }
  }
?>