<?php
namespace Framework\_engine\_core;

/**
 * Class: URI
 *    
 * This class parses the URL of the page and allows gathering of URI fragments and requests
 */
class URI{
   /**
    * The scheme of an URI.
    *    
    * @var    string    
    * @access public    
    */       
   public $scheme = null;
   
   /**
    * The source of an URI. 
    * The source represents associative array of the following structure: array('port' => ..., 'host' => ..., 'user' => ..., 'pass' => ...)
    * 
    * @var    array
    * @access public             
    */       
   public $source = array();
   
   /**
    * The path component of an URI.
    * 
    * @var    array
    * @access public            
    */       
   public $path = array();
   
   /**
    * The query component of an URI.
    * 
    * @var    array
    * @access public            
    */       
   public $query = array();
   
   /**
    * The fragment of an URI
    * 
    * @var    string
    * @access public            
    */       
   public $fragment = null;

   /**
    * Constructs a new URI.
    * 
    * - new URI() parses current URI of a page.
    * 
    * - new URI($uri) parses given URI - $uri.                 
    * 
    * @param string $uri
    * @access public           
    */       
   public function __construct($uri = null){
   	  if (is_null($uri)) $uri = (substr($_SERVER['SERVER_PROTOCOL'], 0, 5) == 'HTTPS' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $this->parse($uri);
   }

   /**
    * Returns URI. 
    *
    * @return string 
    * @access public       
    */           
   public function getURI(){      
      switch ($this->scheme){
   	     case 'http':
   	     case 'https':
           return $this->scheme . (($this->scheme) ? '://' : '') . $this->getQueryString();
      }
   }
   
   /**
    * Returns the query component of an URI
    * 
    * @return string
    * @access public             
    */       
   public function getQueryString(){
      switch ($this->scheme){
   	     case 'http':
   	     case 'https':
           $query = $this->getQuery();
           return $this->getPath() . (($query) ? '?' . $query : '') . (($this->fragment) ? '#' . $this->fragment : '');
      }
   }
   
   /**                                  
    * Returns the path component of an URI
    * 
    * @return string
    * @access public            
    */
   public function getPath(){
     $path = implode('/', $this->path);
     return ($path[0] == '/') ? $path : '/' . $path;
   }

   /**                                  
    * Returns the query component of an URI
    * 
    * @return string
    * @access public            
    */
   public function getQuery(){
      switch ($this->scheme){
   	     case 'http':
   	     case 'https':
           return http_build_query($this->query);
      }
   }
   
   /**
    * Parsing of some URI
    * 
    * @param string $url
    * @access public            
    */       
   public function parse($url){
   	  preg_match_all('@^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?@', urldecode($url), $arr);
   	  $this->scheme = strtolower($arr[2][0]);
   	  $this->path = (strlen($arr[5][0])) ? explode('/', $arr[5][0]) : array();
   	  if (count($this->path) > 1) array_shift($this->path);
   	  $this->path = array_filter($this->path);
   	  $this->query = array();
   	  if (strlen($arr[7][0])){
        foreach (explode('&', $arr[7][0]) as $param){
     	     $data = explode('=', $param);
     	     $this->query[$data[0]] = $data[1];
     	  }
      }
   	  $this->fragment = $arr[9][0];   	  
   }   
}
?>