<?php
namespace Framework\_engine\_db\_mongo;

  /**
   * Class: MongoGenerator
   *    
   * This class constructs MongoDB querys
   */
  class MongoGenerator{
    
    /**  
     * BSON Types
     */
    const BSON_DOUBLE = 1;
    const BSON_STRING = 2;
    const BSON_OBJECT = 3;
    const BSON_ARRAY = 4;
    const BSON_BINARY_DATA = 5;
    const BSON_UNDEFINED = 6;
    const BSON_OBJECT_ID = 7;
    const BSON_BOOLEAN = 8;
    const BSON_DATE = 9;
    const BSON_NULL = 10;
    const BSON_REGEX = 11;
    const BSON_JS = 13;
    const BSON_SYMBOL = 14;
    const BSON_JS_SCOPE = 15;
    const BSON_32BIT_INT = 16;
    const BSON_TIMESTAMP = 17;
    const BSON_64BIT_INT = 18;
    const BSON_MIN_KEY = 255;
    const BSON_MAX_KEY = 127;

    /**  
     * Inequality Constants
     */
    const COMPARE_GT = 0;
    const COMPARE_GTE = 1;
    const COMPARE_LT = 2;
    const COMPARE_LTE = 3;
    const COMPARE_IN = 4;
    const COMPARE_NIN = 5;
    const COMPARE_NE = 6;

    /**  
     * Logic Constants
     */
    const LOGICAL_OR = 0;
    const LOGICAL_AND = 1;
    const LOGICAL_NOT = 2;
    const LOGICAL_NOR = 3;
    
    /**
     * Creates an projection aggregation stage query
     * Describes what keys are used in the query and how to represent these keys.
     * 
     * @return mixed array
     * @param array $params
     * @access public            
     */
    public function projectStage($params){
      return array('$project' => $params);
    }

    /**
     * Creates an match aggregation stage query
     * Works like the "find" query where only the documents that match the query will be filtered to the next stage
     * 
     * @return mixed array
     * @param array $params
     * @access public            
     */
    public function matchStage($params){
      return array('$match' => $params);
    }

    /**
     * Creates an group aggregation stage query
     * Creates an aggregation group that will perform operations on the previous aggregation stage
     * 
     * @return mixed array
     * @param array $params
     * @access public            
     */
    public function groupStage($params){
      return array('$group' => $params);
    }

    /**
     * Creates an sort aggregation stage query
     * Sorts the results of the aggregation stage by some key
     * 
     * @return mixed array
     * @param array $params
     * @access public            
     */
    public function sortStage($params){
      return array('$sort' => $params);
    }

    /**
     * Creates an skip aggregation stage query
     * Skips a number from the resulting aggregation stage from being reported to the next stage
     * 
     * @return mixed array
     * @param int $skipNum
     * @access public            
     */
    public function skipStage($skipNum){
      return array('$skip' => $skipNum);
    }

    /**
     * Creates an limit aggregation stage query
     * Limits how many results from an previous stage will be represented in an aggregation
     * 
     * @return mixed array
     * @param int $limitNum
     * @access public            
     */
    public function limitStage($limitNum){
      return array('$limit' => $limitNum);
    }

    /**
     * Creates an unwind query
     * The unwind aggregation operation flattens an array and creates as many documents are there are items in the array. 
     * Each array value is represented in it's own document as the value of the original array key
     * 
     * @return mixed array
     * @param string $param
     * @access public            
     */
    public function unwindStage($param){
      return array('$unwind' => $param);
    }

    /**
     * Creates the syntax for sum aggregation operations. The $key or an integer is passed in as the sum parameter.
     * This takes a key from the prev set and sums the values from the set and returns the value in the resulting set's key
     * 
     * @return string array
     * @param string $key
     * @param int $inc
     * @access public
     */
    public function sumAggOp($key = "", $inc = 1){
      $sumVar = ($key != "") ? '$'.$key : $inc;
      return array('$sum' => $sumVar);    
    }

    /**
     * Creates the syntax for average aggregation operations. The $key is passed in as the avg parameter.
     * This takes a key from the prev set and averages the values from the set and returns the value in the resulting set's key
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function avgAggOp($key){
      return array('$avg' => "$".$key);    
    }

    /**
     * Creates the syntax for min aggregation operations. The $key is passed in as the min parameter
     * This finds the min value for a key within a set
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function minAggOp($key){
      return array('$min' => "$".$key);    
    }

    /**
     * Creates the syntax for max aggregation operations. The $key is passed in as the max parameter
     * This finds the max value for a key within a set
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function maxAggOp($key){
      return array('$max' => "$".$key);    
    }

    /**
     * Creates the syntax for first operations. The $key is passed in as the first parameter.
     * This gets the first value of a key in a set, this only is useful if the set has been sorted first
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function firstAggOp($key){
      return array('$first' => "$".$key);    
    }

    /**
     * Creates the syntax for last aggregation operations. The $key is passed in as the last parameter
     * This gets the last value of a key in a set, this only is useful if the set has been sorted first
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function lastAggOp($key){
      return array('$last' => "$".$key);    
    }

    /**
     * Creates the syntax for push aggregation operations. The $key is passed in as the push parameter
     * This pushes a value onto the resulting set. This value does not have to be unique to the set
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function pushAggOp($key){
      return array('$push' => "$".$key);    
    }

    /**
     * Creates the syntax for addToSet aggregation operations. The $key is passed in as the addToSet parameter
     * This adds a unique value to a set. If the set already has that particular value in the set, the operation does nothing.
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function addToSetAggOp($key){
      return array('$addToSet' => "$".$key);    
    }

    /**
     * Creates the syntax for addToSet normal operations. The $key is passed in as the addToSet parameter, $values is set to the $key parameter
     * This adds a unique value to a set. If the set already has that particular value in the set, the operation does nothing.
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function addToSetOp($key, $values){
      return array('$addToSet' => array($key => $values));    
    }

    /**
     * Creates the syntax for push normal operations. The $key is passed in as the push parameter, $values is set to the $key parameter
     * This adds a value to a set. There is no 'unique' restriction as there is in addToSet
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function pushOp($key, $values){
      return array('$push' => array($key => $values));    
    }

    /**
     * Creates the syntax for pull normal operations. The $key is passed in as the pull parameter, $values is set to the $key parameter
     * This removes a value from the set, no matter where it lies in the set
     * 
     * @return string array
     * @param string $key
     * @access public
     */
    public function pullOp($key, $values){
      return array('$pull' => array($key => $values));    
    }

    /**
     * Creates the syntax for set operations. The $values is passed in as the set parameter
     * 
     * @return mixed array
     * @param mixed array $values
     * @access public
     */
    public function setOp($values){
      return array('$set' => $values);    
    }

    /**
     * Creates the syntax for inc operations. The $values is passed in as the inc parameter
     * 
     * @return mixed array
     * @param mixed array $values
     * @access public
     */
    public function incOp($values){
      return array('$inc' => $values);    
    }

    /**
     * Creates the syntax for unset operations. The $values is passed in as the unset parameter
     * 
     * @return mixed array
     * @param mixed array $values
     * @access public
     */
    public function unsetOp($values){
      return array('$unset' => $values);    
    }

    /**
     * Creates the syntax for the type operation.
     * This queries the database to find a key by a specific BSON Type
     * 
     * @return array
     * @param string $key
     * @param int $type
     * @access public
     */
    public function typeOp($key, $type){
      return array($key => array('$type' => $type));    
    }

    /**
     * Creates the syntax for the exists operation.
     * This queries the database to find a key exists in a document
     * 
     * @return array 
     * @param string $key
     * @param boolean $existType
     * @access public
     */
    public function existOp($key, $existType){
      return array($key => array('$exists' => $existType));    
    }

    /**
     * Creates the syntax for the inequality operations.
     * This queries the database to find a key where the values satisfy the inequalities
     * 
     * @return array 
     * @param string $key
     * @param string $compareVal
     * @param string $compareType
     * @access public
     */
    public function inequalityOp($key, $compareVal, $compareType){
      $compareOp = "";
      switch($compareType){
        case self::COMPARE_GT:
            $compareOp = '$gt';
            break;
        case self::COMPARE_GTE:
            $compareOp = '$gte';
            break;
        case self::COMPARE_LT:
            $compareOp = '$lt';
            break;
        case self::COMPARE_LTE:
            $compareOp = '$lte';
            break;
        case self::COMPARE_IN:
            $compareOp = '$in';
            break;
        case self::COMPARE_NIN:
            $compareOp = '$nin';
            break;
        case self::COMPARE_NE:
            $compareOp = '$ne';
            break;
      }
      return array($key => array($compareOp => $compareVal));    
    }

    /**
     * Creates the syntax for the logic operations.
     * This queries the database to find a documents where the values satisfy the logic expressions
     * 
     * @return string
     * @param mixed array $expArr
     * @param int $logicType
     * @access public
     */
    public function logicOp($expArr, $logicType){
      $logicOperator = "";
      switch($logicType){
        case self::LOGICAL_OR:
            $logicOperator = '$or';
            break;
        case self::LOGICAL_AND:
            $logicOperator = '$and';
            break;
        case self::LOGICAL_NOT:
            $logicOperator = '$not';
            break;
        case self::LOGICAL_NOR:
            $logicOperator = '$nor';
            break;
      }
      return array($logicOperator => $expArr);    
    }
  }
?>