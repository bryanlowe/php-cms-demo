<?php
namespace Framework\_engine\_db;

  /**
   * Class: SQLGenerator
   *    
   * This class constructs SQL querys
   */
  class SQLGenerator{
    
    /**
     * The database table being queried
     * 
     * @var $dbTable
     * @access private            
     */
    private $dbTable = null;
    
    /**
     * Constructs a new SQLGenerator object
     * 
     * @param string $dbTable
     * @access public            
     */
    public function __construct($dbTable = null){
      $this->dbTable = $dbTable;
    }

    /**
     * Sets the current table to a new table 
     * 
     * @param string $dbTable
     * @access public            
     */
    public function setDBTable($dbTable){
       $this->dbTable = $dbTable;
    }
    
    /**
     * Creates an insert query
     * 
     * @return string $sql
     * @param array $params
     * @access public            
     */
    public function insert($params){
      if(count($params)){
        $sql = "INSERT INTO ".$this->dbTable." (".implode(',',$params).") 
        VALUES (:".implode(",:", $params).")";
        return $sql;
      }
    }
    
    /**
     * Creates an update query
     * 
     * @return string $sql
     * @param array $params
     * @access public            
     */  
    public function update($params){
      if(count($params)){
        $sql = "UPDATE ".$this->dbTable." SET ";
        foreach($params as $value){
          $updateValues[] = $value." = :".$value;
        }
        return $sql.implode(",",$updateValues);
      }
    }
    
    /**
     * Creates an select query
     * 
     * @return string $sql
     * @param array $params
     * @access public            
     */
    public function select($params){
      if(count($params)){
        $sql = "SELECT ".implode(",",$params)." FROM ".$this->dbTable;
      }
      return $sql;
    }
    
    /**
     * Creates an join query
     * 
     * @return string $sql
     * @param array $params
     * @param array $tables
     * @access public            
     */
    public function join($params, $tables){
      $sql = "";
      $fields = $join = array();
      if(count($params, COUNT_RECURSIVE) && count($tables, COUNT_RECURSIVE)){
        $sql .= "SELECT ";
        $fields = $this->listFields($this->dbTable, $params[$this->dbTable]);  
        foreach($tables as $tb => $cond){
          $join[] = $cond['join']." ".$tb." ON ".$cond['on'];
          $fields = array_merge($fields, $this->listFields($tb, $params[$tb]));
        }
        $sql .= (count($fields)) ? implode(", ", $fields)." FROM ".$this->dbTable : "* FROM ".$this->dbTable;
        $sql .= (count($join)) ? " ".implode(" ", $join) : " ";
      }
      return $sql;
    }

    /**
     * Creates an array of all fields assoc with a table for a join query
     * 
     * @return array $fields 
     * @param string $table
     * @param array $params
     * @access public            
     */
    public function listFields($table, $params){
      $fields = array();
      foreach($params as $field){
        $fields[] = $table.".".$field;
      }
      return $fields;
    }
    
    /**
     * Creates an delete query fragment
     * 
     * @return string 
     * @access public            
     */
    public function delete(){
      return "DELETE FROM ".$this->dbTable;
    }
    
    /**
     * Creates an show columns query
     * 
     * @return string 
     * @access public            
     */
    public function showColumns(){
      return "SHOW COLUMNS FROM ".$this->dbTable;
    }
    
    /**
     * Creates an show tables query
     * 
     * @return string 
     * @access public            
     */
    public function showTables(){
      return "SHOW TABLES";
    }
  }
?>