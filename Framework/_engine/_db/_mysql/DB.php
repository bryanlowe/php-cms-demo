<?php
namespace Framework\_engine\_db\_mysql;
use PDO;

  /**
   * Class: DB
   *    
   * PDO is used to interface with the database
   */
  class DB extends PDO{

    /**  
     * Switch case constants are used to determine which database action is taken
     */
    const DB_EXEC = 0;
    const DB_COLUMN = 1;
    const DB_COLUMNS = 2;
    const DB_ROW = 3;
    const DB_ROWS = 4;
    
    /**
     * Creates a new database connection
     * 
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @access public            
     */
    public function __construct($dsn, $username, $password){
      try{
        parent::__construct($dsn, $username, $password);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(Exception $e) {
        echo $e->getMessage();
      }
    }
    
    /**
     * Returns a single column based on SQL query
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @access public            
     */
    public function column($sql, $params = array()){
      return $this->execute($sql, $params, self::DB_COLUMN);
    }
    
    /**
     * Returns a several columns based on SQL query
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @access public            
     */
    public function columns($sql, $params = array()){
      return $this->execute($sql, $params, self::DB_COLUMNS);
    }
    
    /**
     * Returns a single row based on SQL query
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @param const $style
     * @access public            
     */
    public function row($sql, $params = array(), $style = PDO::FETCH_ASSOC){
      return $this->execute($sql, $params, self::DB_ROW, $style);
    }
    
    /**
     * Returns a several rows based on SQL query
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @param const $style
     * @access public            
     */
    public function rows($sql, $params = array(), $style = PDO::FETCH_ASSOC){
      return $this->execute($sql, $params, self::DB_ROWS, $style);
    }
    
    /**
     * Executes SQL query
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @access public            
     */
    public function exec($sql, $params = array()){
      return $this->execute($sql, $params, self::DB_EXEC);
    }
    
    /**
     * Controls and executes all PDO actions
     * 
     * @return mix array
     * @param string $sql
     * @param string $params
     * @param const $type
     * @param const $style
     * @access public            
     */
    public function execute($sql, $params, $type = self::DB_EXEC, $style = PDO::FETCH_BOTH){
       $statement = parent::prepare($sql);
       foreach((array)$params as $key => $value){
         $statement->bindValue(':'.$key, $value);
       }
       $statement->execute();
       
       switch($type){
           case self::DB_EXEC:
             $data = $statement->rowCount();
             break;
           case self::DB_COLUMN:
             $data = $statement->fetchColumn();
             if (is_array($data)) $data = end($data);
             break;
           case self::DB_COLUMNS:
             $data = array(); while ($row = $statement->fetch($style)) $data[] = array_shift($row);
             break;
           case self::DB_ROW:
             $data = $statement->fetch($style);
             if ($data === false) $data = array();
             break;
           case self::DB_ROWS:
             $data = $statement->fetchAll($style);
             break;
       }
       return $data;
    }
  }
?>