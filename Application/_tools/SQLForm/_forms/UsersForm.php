<?php
  namespace Application\_tools\SQLForm\_forms;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;
  use Application\_engine\_bll\_collection as Collection;
  use Framework\_engine\_core\Encryption as Encryption;

  /**
   * Class: UsersForm
   *    
   * Creates a Selection object based on users, creates forms, saves and deletes database entries.
   */  
  class UsersForm extends Form{

    /**
     * Encryption class object
     *
     * @access private
     */
    private $pass_enc = null;


    public function __construct($objectID = null){
      parent::__construct('users', $objectID);
      $this->pass_enc = new Encryption(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
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
        $values['password'] = base64_encode($this->pass_enc->encrypt($values['password'], $this->config->loginKey));
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
      $user = foo(new Collection\UsersCollection())->getByQuery('email = '.$this->db->quote($values['email']));  
      $userCount = count($user);
      if($userCount > 0){
        $user = array_shift($user);
        $this->objectID = $user['user_id'];
      }
      return 'unique';
    }
  }
?>