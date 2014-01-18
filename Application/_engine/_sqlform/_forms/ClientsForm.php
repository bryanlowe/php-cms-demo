<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;

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