<?php
namespace Framework\_engine\_core;

/**
 * Class: Register
 *    
 * This class creates an instance of itself and holds single instance objects for the page
 */
class Register{                   
   /**
    * The instance of class object.
    * 
    * @var    Register
    * @access private
    * @static                
    */       
   private static $instance = null;
   
   /**
    * The array of global objects.
    * 
    * @var    array
    * @access private
    * @static                
    */       
   private static $objects = array();
   
   /**
    * Constructs a single instance of the this class.
    * 
    * @access private        
    */       
   private function __construct(){}
   
   /**
    * Clones the instance of the class.
    * 
    * @access private        
    */        
   private function __clone(){}
   
   /**
    * Returns the single instance of this class.
    * 
    * @return Register     
    * @access public    
    * @static        
    */       
   public static function getInstance(){
      if (self::$instance === null) self::$instance = new self();
      return self::$instance;
   }  
   
   /**
    * Returns an global object by its key.
    * 
    * @param mixed $key
    * @return mixed
    * @access public                
    */       
   public function __get($key){                       
      return $this->get($key);
   }
   
   /**
    * Adds new global object that associated with a key.
    * 
    * @param mixed $key
    * @param mixed $obj
    * @access public                
    */       
   public function __set($key, $obj){
      $this->set($key, $obj);
   }
   
   /**
    * Returs a global object by its key.
    * 
    * @param mixed $key
    * @return mixed           
    */       
   public function get($key){
      return self::$objects[$key];
   }
   
   /**
    * Adds new global object that associated with a key.
    * 
    * @param mixed $key
    * @param mixed $obj   
    * @return Register 
    * @access public                     
    */     
   public function set($key, $obj){
      self::$objects[$key] = $obj;
      return $this;
   }
   
   /**
    * Deletes a global object by its key.
    * 
    * @param mixed $key
    * @return Register
    * @access public                
    */       
   public function delete($key){
      unset(self::$objects[$key]);
      return $this;
   }
   
   /**
    * Checks whether or not exist a global object.
    * 
    * @param mixed $key
    * @return boolean
    * @access public                
    */       
   public function exists($key){
      return isset(self::$objects[$key]);
   }  
}
?>