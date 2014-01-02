<?php
  namespace Framework\_engine\_dal;
  use Framework\_engine\_core\Register as Register;
  
  /**
   * Class: Selection
   *    
   * This class gathers a single selected result from a database table.
   * The selection is also able to perform database actions onto itself.
   */
  class Selection{

    /**
     * The name of the table used in this selection
     * 
     * @var string $objectName
     * @access protected            
     */
    protected $objectName = null;

    /**
     * The instance of the DB class
     * 
     * @var $db
     * @access protected            
     */
    protected $db = null;
    
    /**
     * Creates an instance of the Selection class
     * 
     * @param string $object
     * @access public            
     */
    public function __construct($object){
      $this->objectName = $object;
      $this->db = Register::getInstance()->get('db');
    }
    
    /**
     * Gets a selected database record by ID and sets it in an assoc array
     * 
     * @return DALTable $tb
     * @param string $primaryID
     * @access public            
     */
    public function getByID($primaryID = null){
      $tb = $this->getDAL();
      if($tb->primaryKeySet($primaryID)){
        $tb->assign();
      }
      return $tb;
    }
    
    /**
     * Updates a selected database record by ID and assoc array params
     * 
     * @param string $primaryID
     * @param array $params
     * @access public            
     */
    public function updateByID($primaryID, $params){
      $tb = $this->getDAL();
      if($tb->primaryKeySet($primaryID)){
        $tb->assign($params);
        $tb->save();
      }
    }
    
    /**
     * Deletes a selected database record by ID
     * 
     * @param string $primaryID
     * @access public            
     */
    public function deleteByID($primaryID){
      $tb = $this->getDAL();
      if($tb->primaryKeySet($primaryID)){
        $tb->remove();
      }
    }
    
    /**
     * Returns a DALTable object instantiated with the Selection class table
     * 
     * @return DALTable object
     * @access public            
     */
    public function getDAL(){
      return new DALTable($this->objectName);
    }
    
    /**
     * Saves the values of an open DALTable table object to the database
     * 
     * @param DALTable $tb
     * @access public            
     */
    public function save(DALTable $tb){
      $tb->save();
    }
    
    /**
     * Removes the values of an open DALTable table object from the database
     * 
     * @param DALTable $tb
     * @access public            
     */
    public function delete(DALTable $tb){
      $tb->remove();
    }
  }
?>
