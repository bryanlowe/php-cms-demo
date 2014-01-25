<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\InvoicesCollection as InvoicesCollection;
  use Application\_engine\_bll\_collection\ProjectsCollection as ProjectsCollection;

  /**
   * Class: ClientsForm
   *    
   * Creates a Selection object based on clients, creates forms, saves and deletes database entries.
   */  
  class ClientsForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('clients', $objectID);
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
        $values['client_id'] = $this->objectID;
        return parent::save($values);
      }
      return $result;
    }

    /**   
     * Deletes the form entry from the table
     * First any invoices that exist for the client, then projects, then the client itself
     *
     * @return string
     * @param string $primaryKey
     * @access public
     */
    public function delete($primaryKey){
      $invoices = foo(new InvoicesCollection())->getByQuery('client_id = '.$this->db->quote($primaryKey));
      $projects = foo(new ProjectsCollection())->getByQuery('client_id = '.$this->db->quote($primaryKey));
      
      $maxInvoices = count($invoices);
      for($i = 0; $i < $maxInvoices; $i++){
        if(($result = foo(new InvoicesForm())->delete($invoices[$i]['invoice_id'])) != 'Deletion Success'){
          return $result;
        }
      }

      $maxProjects = count($projects);
      for($i = 0; $i < $maxProjects; $i++){
        if(($result = foo(new ProjectsForm())->delete($projects[$i]['project_id'])) != 'Deletion Success'){
          return $result;
        }
      }
      if(($result = parent::delete($primaryKey)) == "Deletion Error"){
        return 'Error Deleting Client. ClientID: '.$primaryKey;
      }
      return $result;
    }

    /**   
     * Validates whether the form values are unique to the database
     *
     * @return string
     * @param mixed array $values
     * @access protected
     */
    protected function validateUnique($values){
      $client = foo(new ClientsCollection())->getByQuery('email = '.$this->db->quote($values['email']));  
      $clientCount = count($client);
      if($clientCount > 0){
        $client = array_shift($client);
        $this->objectID = $client['client_id'];
      }
      return 'unique';
    }
  }
?>