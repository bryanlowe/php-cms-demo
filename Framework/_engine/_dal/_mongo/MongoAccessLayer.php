<?php
  namespace Framework\_engine\_dal\_mongo;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_db\_mongo\MongoGenerator as MongoGenerator;
  
  /**
   * Class: MongoAccessLayer
   *    
   * This class allows a selection object to perform actions directly to the database
   */
  class MongoAccessLayer{

    /**
     * MongoGenerator Object
     *
     * @access protected
     */
    protected $mongoGen = null;

    /**
     * The instance of the MongoDB class
     * 
     * @var $mongodb
     * @access protected            
     */
    protected $mongodb = null;

    /**
     * The instance of the MongoCollection class
     * 
     * @var $collection
     * @access protected            
     */
    protected $collection = null;
    
    /**
     * Creates an instance of the MongoAccessLayer class
     * 
     * @param string $collection
     * @access public            
     */
    public function __construct($collection){
      $this->mongodb = Register::getInstance()->get('mongodb');
      $this->collection = $collection;
      $this->mongoGen = new MongoGenerator();
      $this->mongodb->switchCollection($collection);
    }

    /**
     * Gets the doc by _id
     *    
     * @return mixed array results
     * @param mixed $_id
     * @param boolean $mongoid    
     * @access public
     */
    public function getDocByID($_id, $mongoid = true){
      if($mongoid == true){
        $_id = new \MongoId($_id);
      }
      return $this->mongodb->getDocument(array('_id' => $_id));
    }

    /**
     * Join 2 collections together by _id keys stored in the first document to the _id in the second document
     *
     * @return mixed array $docs
     * @param mixed array $docs - documents from the first collection
     * @param string $subCollection - the second collection
     * @param string $key - this key is from the first collection that maps to the _id of the second collection  
     */
    public function joinCollectionsByID($docs, $subCollection, $key){
      $this->mongodb->switchCollection($subCollection);
      $results = array();
      if(is_object($docs)){
        while($docs->hasNext()){
          $item = $docs->getNext();
          $item[$subCollection] = $this->mongodb->getDocument(array('_id' => $item[$key]));
          $results[] = $item;
        }
      } else if(is_array($docs)){
        $count = count($docs);
        for($i = 0; $i < $count; $i++){
          $docs[$i][$subCollection] = $this->mongodb->getDocument(array('_id' => $docs[$i][$key])); 
          $results[] = $docs[$i];
        }
      }
      return $results;
    }

    /**
     * Saves a doc to the database
     *
     * @return mixed array results
     * @param mixed array $values    
     * @param mixed $_id
     * @param boolean $mongoid    
     * @access public
     */
    public function saveDocEntry($values, $_id = '', $mongoid = true){
      $docCount = $this->mongodb->getCount(array('_id' => $_id));
      $insert = ($_id != '' && $docCount > 0) ? false : true;
      if($mongoid == true){
        $_id = ($_id != '') ? new \MongoId($_id) : new \MongoId();
      }
      if($insert){
        $values['_id'] = $_id;
        return $this->mongodb->insertDocument($values);
      } else {
        return $this->mongodb->updateDocument(array("_id" => $_id), $this->mongoGen->setOp($values));
      }    
    }

    /**
     * Saves a unique set value to a doc in the database
     *
     * @return mixed array results
     * @param string $set  
     * @param mixed array $values    
     * @param mixed $_id
     * @param boolean $mongoid    
     * @access public
     */
    public function addSetToDocEntry($set, $values, $_id, $mongoid = true){
      if($mongoid == true){
        $_id = ($_id != '') ? new \MongoId($_id) : new \MongoId();
      }
      return $this->mongodb->updateDocument(array("_id" => $_id), $this->mongoGen->addToSetOp($set,$values));   
    }

    /**
     * Deletes a doc from the database
     *
     * @return mixed array results
     * @param mixed $_id
     * @param boolean $mongoid  
     * @access public
     */
    public function deleteDocEntry($_id, $mongoid = true){
      if($mongoid == true){
        $_id = new \MongoId($_id);
      }
      return $this->mongodb->deleteDocument(array('_id' => $_id));
    }
  }
?>
