<?php
  namespace Framework\_engine\_dal\_mysql;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_db\_mysql\SQLGenerator as SQLGenerator;
  
  /**
   * Class: DALTable
   *    
   * This class allows a selection object to perform actions directly to the database
   */
  class DALTable{

    /**
     * The name of the table used in this collection
     * 
     * @var string $table
     * @access protected            
     */
    protected $table = null;

    /**
     * Contains the table column names of the table
     * 
     * @var array $columns
     * @access protected            
     */
    protected $columns = array();

    /**
     * Table primary key name
     * 
     * @var string $primaryKey
     * @access protected            
     */
    protected $primaryKey = null;

    /**
     * The instance of the DB class
     * 
     * @var $db
     * @access protected            
     */
    protected $db = null;
    
    /**
     * Creates an instance of the DALTable class
     * 
     * @param string $table
     * @access public            
     */
    public function __construct($table){
      $this->table = $table;
      $this->db = Register::getInstance()->get('db');
      $this->setColumns();
    }
    
    /**
     * Sets value to a table column
     * 
     * @param string $param
     * @param string $value
     * @access public            
     */
    public function __set($param, $value){
      if(array_key_exists($param, $this->columns)){
        $this->columns[$param] = $value;
      }
    }
    
    /**
     * Gets value from a table column
     * 
     * @return mixed
     * @param string $param
     * @access public            
     */
    public function __get($param){
      if(array_key_exists($param, $this->columns)){
        return $this->columns[$param];
      } 
    }
    
    /**
     * Checks to see if a specific primary key is present in a table, if so then the current primary key is set to a new one
     *
     * @return boolean 
     * @param mixed $key
     * @access public            
     */
    public function primaryKeySet($key){
      if($key != null){
        $sql = new SQLGenerator($this->table);
        $select = $sql->select(array_keys($this->columns));
        $select .= ' WHERE '.$this->primaryKey.' = "'.$key.'"';
        if(count($this->db->rows($select, $this->columns))){
          $this->columns[$this->primaryKey] = $key;
          return true;
        }
      }
      return false;
    }
    
    /**
     * Assigns values from database table columns to table object columns 
     * 
     * @param array $params
     * @access public            
     */
    public function assign($params = array()){
      if(count($params)){
        $this->setValues($params);
      } else {
        $sql = new SQLGenerator($this->table);
        $select = $sql->select(array_keys($this->columns));
        $select .= ' WHERE '.$this->primaryKey.' = "'.$this->columns[$this->primaryKey].'"';
        $result = $this->db->rows($select, $this->columns);
        $result = array_pop($result);
        $this->setValues($result);
      }
    }
    
    /**
     * Sets values to table columns
     * 
     * @param array $params
     * @access public            
     */
    public function setValues($params){
      foreach($params as $key => $value){
        $this->__set($key, $value);
      }
    }
    
    /**
     * Gets values from table columns
     * 
     * @return mixed array
     * @param array $params
     * @access public            
     */
    public function getValues($params = null){
      $columns = array();
      if($params){
        if(is_array($params)){
          foreach($params as $key){
            $columns[$value] = $this->__get($key);
          }
          return $columns;
        } else {
          return $this->__get($params);
        }
      } else {
        return $this->columns;
      }
    }
    
    /**
     * Saves or updates new record to table
     * 
     * @access public            
     */
    public function save(){
      $sql = new SQLGenerator($this->table);
      $temp = $this->columns;
      array_shift($temp);
      if($this->columns[$this->primaryKey]){ 
        $save = $sql->update(array_keys($temp));
        $save .= ' WHERE '.$this->primaryKey.' = "'.$this->columns[$this->primaryKey].'"';
      } else {
        $save = $sql->insert(array_keys($temp));
      }
      $this->db->exec($save, $temp);
    }
    
    /**
     * Removes a record from a table
     * 
     * @access public            
     */
    public function remove(){
      $sql = new SQLGenerator($this->table);
      $delete = $sql->delete();
      $delete .= ' WHERE '.$this->primaryKey.' = "'.$this->columns[$this->primaryKey].'"';
      $this->db->exec($delete);
      foreach($this->columns as $key => $column){
        unset($this->columns[$key]);
      }
      
      if(is_array($this->primaryKey)){
        foreach($this->primaryKey as $key => $value){
          unset($this->primaryKey[$key]);
        }
      } else {
        unset($this->primaryKey);
      }
    }
    
    /**
     * Adds a record to the table
     * 
     * @access public            
     */
    public function add(){
      $sql = new SQLGenerator($this->table);
      $insert = $sql->insert(array_keys($this->columns));
      $this->db->exec($insert);
    }
    
    /**
     * Sets up the columns array with fields from the database
     * 
     * @access private
     */
    private function setColumns(){
      $sql = new SQLGenerator($this->table);
      $columns = $this->db->rows($sql->showColumns());
      foreach($columns as $col){
        $this->columns[$col['Field']] = null;
        if($col['Key'] == "PRI"){
          $this->primaryKey[] = $col['Field'];
        }
      }
      if(count($this->primaryKey) == 1){
        $this->primaryKey = array_pop($this->primaryKey);
      }
    }
  }
?>
