<?php
  namespace Framework\_engine\_dal;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_db\SQLGenerator as SQLGenerator;

  /**
   * Class: Collection
   *    
   * This class gathers a collection of database records from a table
   */
  class Collection{

    /**
     * The name of the table used in this collection
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
     * The instance of the SQLGenerator class
     * 
     * @var $sql
     * @access protected            
     */
    protected $sql = null;
    
    /**
     * Creates an instance of the Collection class
     * 
     * @param string $object
     * @access public            
     */
    public function __construct($object){
      $this->objectName = $object;
      $this->db = Register::getInstance()->get('db');
      $this->sql = new SQLGenerator($this->objectName);
    }
    
    /**
     * Gathers a collection of all the results of a query based on the parameters
     * 
     * @return array
     * @param string start
     * @param string limit
     * @param string where
     * @param string order
     * @access public            
     */
    public function getAll($start = null, $limit = null, $where = null, $order = null){
      $select = 'SELECT * FROM '.$this->objectName;
      $select .= ($where) ? ' WHERE ' . $where : '';
      $select .= ($order) ? ' ORDER BY ' . $order : '';
      if($limit){
        $select .= ($start) ? ' LIMIT ' . $start . ',' . $limit : ' LIMIT ' . $limit;
      }
      return $this->db->rows($select, array()); 
    }
    
    /**
     * Gathers a collection of results of a query based on the parameters
     * 
     * @return array
     * @param string where
     * @param string order
     * @access public            
     */
    public function getByQuery($where, $order = null){
      $select = 'SELECT * FROM '.$this->objectName;
      $select .= ' WHERE ' . $where;
      $select .= ($order) ? ' ORDER BY ' . $order : '';
      return $this->db->rows($select, array()); 
    }
    
    /**
     * Gets the count of a set of records
     * 
     * @return array
     * @param string where
     * @access public            
     */
    public function getCount($where = null){
      $select = 'SELECT COUNT(*) as cnt FROM '.$this->objectName;
      $select .= ($where) ? ' WHERE ' . $where : '';
      return $this->db->column($select, array()); 
    }
}
?>
