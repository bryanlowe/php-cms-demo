<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  
  /**
   * Class: UsersCollection
   *    
   * Collects a set database records from table users and treats them as a collection of object
   */
  class UsersCollection extends Collection{

    /**
     * Encryption class object
     *
     * @access private
     */
    private $pass_enc = null;

    public function __construct(){
      parent::__construct('users');
    }

    /**
     * Checks the user table for a count of users with the given username, password and group type
     * 
     * @param string $username
     * @param string $password
     * @param string $type
     */
    public function getLoginCount($email, $type){
      if($type == "ADMIN"){
        return $this->getCount('email = '.$this->db->quote($email).' AND status = "1" AND user_group_id = "1"');
      } else if($type == "WRITER"){
        return $this->getCount('email = '.$this->db->quote($email).' AND status = "1" AND user_group_id = "2"');
      } else if($type == "CLIENT"){
        return $this->getCount('email = '.$this->db->quote($email).' AND status = "1" AND user_group_id = "3"');
      }
    }
  }
?>