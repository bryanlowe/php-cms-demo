<?php
namespace Framework\_engine\_db\_mongo;
use MongoClient;

  /**
   * Class: DB
   *    
   * MongoDB is used to interface with the database
   */
  class DB {

    /**  
     * Switch case constants are used to determine which database action is taken
     */
    const DB_EXEC = 0;
    const DB_DOCUMENT = 1;
    const DB_DOCUMENTS = 2;
    const DB_AGGREGATE = 3;
    const DB_CREATE_INDEX = 4;
    const DB_DELETE_INDEX = 5;
    const DB_DELETE_ALL_INDEXES = 6;
    const DB_FIND_AND_MODIFY = 7;
    const DB_SAVE = 8;
    const DB_IMPORT = 9;
    const DB_DELETE = 10;
    const DB_COUNT = 11;

    /**
     * MongoClient Obj
     * @access private
     */
    private $mongoClient = null;

    /**
     * Mongo Database Obj
     * @access private
     */
    private $mongoDB = null;

    /**
     * Mongo Collection Obj
     * @access private
     */
    private $mongoCollection = null;
    
    /**
     * Creates a new database connection
     * 
     * @param string $mongohost
     * @param string $mongouser
     * @param string $mongopass
     * @access public            
     */
    public function __construct($mongohost, $mongouser, $mongopass, $mongodbname){
      try{
        $this->mongoClient = new MongoClient("mongodb://".$mongouser.":".$mongopass."@".$mongohost);
        $this->switchDatabase($mongodbname);
      } catch(Exception $e) {
        echo $e->getMessage();
      }
    }

    /**
     * Closes an open database connection
     * @access public
     */
    public function closeDB(){
      $this->mongoClient->close();
    }

    /**
     * Selects or creates a database by name
     * @param $dbname
     * @access public
     */
    public function switchDatabase($dbname){
      if($dbname != ""){
        $this->mongoDB = $this->mongoClient->selectDB($dbname);
      } else {
        $this->mongoDB = null;
      }
    }

    /**
     * Selects or creates a database collection by name
     * @param $collectionName
     * @access public
     */
    public function switchCollection($collectionName){
      if($collectionName != "" && $this->mongoDB != null){
        $this->mongoCollection = $this->mongoDB->selectCollection($collectionName);
      } else {
        $this->mongoCollection = null;
      }
    }

    /**
     * Removes a collection from the database
     * 
     * @return mixed array
     * @param string $collectionName
     * @access public
     */
    public function deleteCollection($collectionName){
      return $this->mongoCollection->drop();
    }
    
    /**
     * Returns a single document based on query array
     * 
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $projection
     * @access public            
     */
    public function getDocument($query = array(), $projection = array()){
      return $this->execute($query, array(), $projection, array(), self::DB_DOCUMENT);
    }
    
    /**
     * Returns a cursor pointing to several documents based on query array
     * 
     * @return mix array
     * @param mixed array $query
     * @param mixed array $projection
     * @access public            
     */
    public function getDocuments($query = array(), $projection = array()){
      return $this->execute($query, array(), $projection, array(), self::DB_DOCUMENTS);
    }

    /**
     * Returns an int count of the documents that match a given query
     * 
     * @return int 
     * @param mixed array $query
     * @param int $limit
     * @param int $skip
     * @access public            
     */
    public function getCount($query = array(), $limit = 0, $skip = 0){
      return $this->execute($query, array(), $projection, array('limit' => $limit, 'skip' => $skip), self::DB_COUNT);
    }

    /**
     * Returns the resulting set of aggregated documents
     * 
     * @return mixed array
     * @param mixed array $pipeline
     * @access public            
     */
    public function aggregateDocs($pipeline){
      return $this->execute($pipeline, array(), array(), array(), self::DB_AGGREGATE);
    }

    /**
     * Creates an index on this collection
     *
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $options
     * @access public
     */
    public function createIndex($query, $options = array()){
      return $this->execute($query, array(), array(), $options, self::DB_CREATE_INDEX);
    }

    /**
     * Deletes an index from this collection
     *
     * @return mixed array
     * @param mixed array $query
     * @access public
     */
    public function deleteIndex($query){
      return $this->execute($query, array(), array(), array(), self::DB_DELETE_INDEX);
    }

    /**
     * Deletes all indexes from this collection
     *
     * @return mixed array
     * @access public
     */
    public function deleteAllIndexes(){
      return $this->execute(array(), array(), array(), array(), self::DB_DELETE_ALL_INDEXES);
    }

    /**
     * Finds and modifies a single document. Returns the document
     * 
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $update
     * @param mixed array $projection
     * @param mixed array $options
     * @access public
     */
    public function findAndUpdate($query, $update, $projection = array(), $options = array()){
      return $this->execute($query, $update, $projection, $options, self::DB_FIND_AND_MODIFY);
    }

    /**
     * Saves a document. If the document doesn't exist in the database, it is inserted
     * 
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $options
     * @access public
     */
    public function updateDocument($query, $options = array()){
      return $this->execute($query, array(), array(), $options, self::DB_SAVE);
    }

    /**
     * Imports as set of documents into the database
     * 
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $options
     * @access public
     */
    public function importDocuments($query, $options = array()){
      return $this->execute($query, array(), array(), $options, self::DB_IMPORT);
    }

    /**
     * Removes a document from the database
     * 
     * @return mixed array
     * @param mixed array $query
     * @param mixed array $options
     * @access public
     */
    public function deleteDocument($query, $options = array()){
      return $this->execute($query, array(), array(), $options, self::DB_DELETE);
    }
    
    /**
     * Executes MongoDB query
     * 
     * @return mixed array
     * @param string $query
     * @access public            
     */
    public function exec($query){
      return $this->execute($query, self::DB_EXEC);
    }
    
    /**
     * Controls and executes all PDO actions
     * 
     * @return mixed array
     * @param mixed array $query
     * @param const $type
     * @access public            
     */
    public function execute($query, $update, $projection, $options, $type = self::DB_EXEC){
      switch($type){
        case self::DB_EXEC:
          $data = $this->mongoDB->command($query);
          break;
        case self::DB_DOCUMENT:
          $data = $this->mongoCollection->findOne($query, $projection);
          break;
        case self::DB_DOCUMENTS:
          $data = $this->mongoCollection->find($query, $projection);
          break;
        case self::DB_COUNT:
          $data = $this->mongoCollection->count($query, $options['limit'], $options['skip']);
          break;
        case self::DB_AGGREGATE:
          $data = $this->mongoCollection->aggregate($query);
          break;
        case self::DB_CREATE_INDEX:
          $data = $this->mongoCollection->ensureIndex($query, $options);
          break;
        case self::DB_DELETE_INDEX:
          $data = $this->mongoCollection->deleteIndex($query);
          break;
        case self::DB_DELETE_ALL_INDEXES:
          $data = $this->mongoCollection->deleteIndexes();
          break;
        case self::DB_FIND_AND_MODIFY:
          $data = $this->mongoCollection->findAndModify($query, $update, $projection, $options);
          break;
        case self::DB_SAVE:
          $data = $this->mongoCollection->save($query, $options);
          break;
        case self::DB_IMPORT:
          $data = $this->mongoCollection->batchInsert($query, $options);
          break;
        case self::DB_DELETE:
          $data = $this->mongoCollection->remove($query, $options);
          break;
      }
      return $data;
    }
  }
?>