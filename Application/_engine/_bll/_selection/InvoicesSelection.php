<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: InvoicesSelection
   *    
   * Selects a database record from table invoices and treats it as an object
   */
  class InvoicesSelection extends Selection{
    public function __construct(){
      parent::__construct('invoices');
    }
  }
?>