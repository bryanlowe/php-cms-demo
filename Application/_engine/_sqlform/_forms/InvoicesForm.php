<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  use Application\_engine\_bll\_collection\InvoicesCollection as InvoicesCollection;
  use Application\_engine\_bll\_collection\InvoiceStatusCollection as InvoiceStatusCollection;
  use Application\_engine\_bll\_collection\InvoiceFilesCollection as InvoiceFilesCollection;

  /**
   * Class: InvoicesForm
   *    
   * Creates a Selection object based on invoices, creates forms, saves and deletes database entries.
   */  
  class InvoicesForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('invoices', $objectID);
    }

    /**   
     * Saves the form inputs to the table
     *
     * @return string
     * @param mixed array $values
     * @access public
     */
    public function save($values){
      if(($result = $this->validateUnique($values)) == 'unique'){
        return parent::save($values);
      }
      return $result;
    }

    /**   
     * Deletes the form entry from the table
     * First any statuses associated with the invoice, then any files associated with the invoice
     *
     * @return string
     * @param string $primaryKey
     * @access public
     */
    public function delete($primaryKey){
      $invoiceStatus = foo(new InvoiceStatusCollection())->getByQuery('invoice_id = '.$this->db->quote($primaryKey));
      $maxStatus = count($invoiceStatus);
      for($i = 0; $i < $maxStatus; $i++){
        if(($result = foo(new Form('invoice_status'))->delete($invoiceStatus[$i]['invoice_status_id'])) == 'Deletion Error'){
          return 'Error deleting invoice status from database. PrimaryID: '.$primaryKey.' Status ID: '.$invoiceStatus[$i]['invoice_status_id'];
        }
      }

      $invoiceFiles = foo(new InvoiceFilesCollection())->getByQuery('invoice_id = '.$this->db->quote($primaryKey));
      $maxFiles = count($invoiceFiles);
      for($i = 0; $i < $maxFiles; $i++){
        if(($result = foo(new Form('invoice_files'))->delete($invoiceFiles[$i]['invoice_file_id'])) == 'Deletion Error'){
          return 'Error deleting invoice files from database. PrimaryID: '.$primaryKey.' Status ID: '.$invoiceFiles[$i]['invoice_file_id'];
        }
        $this->removeInvoiceFile($invoiceFiles[$i]['invoice_filename']);
      }
      return parent::delete($primaryKey);
    }

    /**
     * Remove invoice file from the media archives
     *
     * @param assoc array $param
     * @access public
     */
    public function removeInvoiceFile($invoiceFile){
      unlink($this->config->root.'/Media/_documents/_invoices/'.$invoiceFile);
    }

    /**   
     * Validates whether the form values are unique to the database
     *
     * @return string
     * @param mixed array $values
     * @access protected
     */
    protected function validateUnique($values){
      $uniqueCount = foo(new InvoicesCollection())->getCount('invoice_number = '.$this->db->quote($values['invoice_number']));  
      if($uniqueCount > 0){
        return 'duplicate';
      }
      return 'unique';
    }
  }
?>