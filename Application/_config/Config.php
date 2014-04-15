<?php
  /**
   * Class: Config
   *    
   * Parses the ini files and loads the properties gathered into an assoc array
   */
  class Config{

     /**
      * An array of include directories that should be ignored
      *    
      * @var array $includes
      * @access private
      */
     private $includes = array('css', 'js', 'images', 'xml', 'util', 'temp', 'tempImages', 'tempDocs');

     /**
      * Constructs a new Config class object
      *    
      * @access public
      */
     public function __construct(){
        $this->root = $_SERVER['DOCUMENT_ROOT'];
     }

     /**
      * Returns a string of a directory for the given folder string param
      *  
      * @return string $dir
      * @param string $folder  
      * @access public
      */
     public function dir($folder){
        $dir = (isset($this->dirs[$folder])) ? $this->dirs[$folder] : $folder;
        if(substr($dir, 0, strlen($this->root)) != $this->root && !in_array($folder,$this->includes)) $dir = $this->root . $dir;
        return $dir;
     }

     /**
      * Returns a string of a namespace for the given namespace desc string param
      *  
      * @return string namespace
      * @param string $ns  
      * @access public
      */
     public function getNamespace($ns){
        return (isset($this->namespaces[$ns])) ? $this->namespaces[$ns] : $ns;
     }
     
     /**
      * Parses an initialization file and places the properties in an assoc array
      * 
      * @param string $iniFile  
      * @access public
      */
     public function init($iniFile){
        if (!file_exists($iniFile)) return;
        $data = parse_ini_file($iniFile, true);
        foreach ($data as $section => $properties){
           if ($section == 'dirs'){
             $this->dirs = $properties; 
           } else if ($section == 'namespaces'){ 
             $this->namespaces = $properties; 
           } else if ($section == 'bll-enabled-tables'){
             $this->bllTables = $properties;
           } else if ($section == 'bll-editable-table-columns'){
             $this->bllTableColumns = $properties;
           } else if ($section == 'passwords'){
             $this->passwords = $properties;
           } else if ($section == 'smtp-info'){
             $this->smtpInfo = $properties;
           } else if (is_array($properties)) {
             foreach ($properties as $k => $v) $this->{$k} = $v; 
           } else {
             $this->{$section} = $properties;
           }
        }
     }
     
     /**
      * Sets a PHP Session
      *   
      * @access public
      */
     public function setSession(){
        if(!isset($_SESSION['sessionID'])){ 
          $_SESSION['sessionID'] = md5(date('UTC') . rand(0,1000000));
        }
        $this->sessionID = $_SESSION['sessionID'];
     }
  }

  $config = new Config();
  $config->setSession();
  $config->init($config->root . '/Application/_config/_common/config.ini');
  $config->init($config->root . '/Application/_config/_common/.local.ini');
?>