<?php
  namespace Framework\_widgets\SQLForm\_engine\_core;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_db\_mysql\SQLGenerator as SQLGenerator;

  /**
   * Class: BLLGenerator
   *    
   * This class creates the database business logic classes
   */
  class BLLGenerator{

    /**
     * The instance of the Config Class
     * 
     * @var    $config
     * @access private            
     */
    private $config = null;

    /**
     * The instance of the DB class
     * 
     * @var $db
     * @access private            
     */
    private $db = null;

    /**
     * The instance of the SQLGenerator class
     * 
     * @var $sql
     * @access private            
     */
    private $sql = null;

    /**
     * List of tables in the database
     * 
     * @var $dbInfo
     * @access private            
     */
    private $dbInfo = null;

    /**
     * A multi dimensional array of database records
     * 
     * @var array $inventory
     * @access private            
     */
    private $inventory = array();

    /**
     * String template of the [Table]Selection Class
     * 
     * @var $selectionTemplate
     * @access private            
     */
    private $selectionTemplate = null;

    /**
     * String template of the [Table]Collection Class
     * 
     * @var $collectionTemplate
     * @access private            
     */
    private $collectionTemplate = null;
    
    /**
     * Creates an instance of the BLLGenerator class
     * 
     * @access public            
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');
      $this->db = Register::getInstance()->get('db');
      $this->sql = new SQLGenerator();
      $this->dbInfo = $this->db->columns($this->sql->showTables());
      $bll_settings = $this->getBLLSettings();
      $this->inventory = $bll_settings->xpath("inventory/item[@enabled='1']");
      $this->selectionTemplate = file_get_contents($this->config->dir('templates') . '/_bll/selection.txt');
      $this->collectionTemplate = file_get_contents($this->config->dir('templates') . '/_bll/collection.txt');
    }
    
    /**
     * Generates business logic classes for each table
     * 
     * @access public            
     */
    public function generate(){
      $this->createSelectionClasses();
      $this->createCollectionClasses();
    }

    /**   
     * Generates and retrieves BLL settings
     *
     * @access private
     */
    private function getBLLSettings(){
      if(!file_exists($this->config->dir('bll').'/_settings/bll_settings.xml')){
         $this->generateBLLSettings();
      }
      return new \SimpleXMLElement(file_get_contents($this->config->dir('bll').'/_settings/bll_settings.xml'));
    }
    
    /**   
     * Generates BLL settings
     *
     * @access private
     */
    private function generateBLLSettings(){
      $settings = new \DOMDocument();
      $settings->formatOutput = true;
      $settings->preserveWhiteSpace = false;
      $root = $settings->createElement('bll_config');
      $rootNode = $settings->appendChild($root);
      $inventory = $settings->createElement('inventory');
      
      foreach($this->dbInfo as $table){
        $item = $settings->createElement('item');
        if(array_key_exists($table, $this->config->bllTables)){
          $item->setAttribute('enabled', '1');
        } else {
          $item->setAttribute('enabled', '0');
        }
        $value = $settings->createTextNode($this->config->bllTables[$table]);
        $name = $settings->createElement('name');
        $name->appendChild($value);
        $item->appendChild($name);

        $value = $settings->createTextNode($table);
        $tableNode = $settings->createElement('table');
        $tableNode->appendChild($value);
        $item->appendChild($tableNode);
        
        $this->sql->setDBTable($table);
        $tableColumns = $this->db->rows($this->sql->showColumns());
        foreach($tableColumns as $column){
          $feature = $settings->createElement('feature');
          if($column['Null'] == 'NO'){
            $feature->setAttribute('required', '1');
          } else {
            $feature->setAttribute('required', '0');
          }
          
          if($this->isNumericField($column['Type'])) {
            $feature->setAttribute('numeric', '1');
          } else {
            $feature->setAttribute('numeric', '0');
          }

          if(substr_count($column['Type'], "set(") > 0
          || substr_count($column['Type'], "enum(") > 0){
            $feature->setAttribute('inputOptions', str_replace(array("set('","enum('", "')","','"), array("","","",","), $column['Type']));
          } else {
            $feature->setAttribute('inputOptions', "");
          }
          
          if(in_array($column['Field'], explode('::',$this->config->bllTableColumns[$table]))){
            $feature->setAttribute('visible', '1');
          } else {
            $feature->setAttribute('visible', '0');
          }
          
          if($column['Key'] == 'PRI'){
            $feature->setAttribute('visible', '1');
            $feature->setAttribute('primaryKey', '1');
          } else {
            $feature->setAttribute('primaryKey', '0');
          }
          
          $featureValue = $settings->createTextNode($column['Field']);
          $feature->appendChild($featureValue);
          $item->appendChild($feature); 
        }
        $inventory->appendChild($item);
      }
      $rootNode->appendChild($inventory);
      $settings->save($this->config->dir('bll').'/_settings/bll_settings.xml');
    }
    
    /**   
     * Checks a table column to determine if it is numeric
     *
     * @return boolean
     * @param string $type
     * @access private 
     */
    private function isNumericField($type){  
      $numericTypes = array('tinyint', 'bigint', 'smallint', 'int', 'mediumint');
      foreach($numericTypes as $num){
        if(substr_count($type, $num) > 0){
          return true;
        }
      }
      return false;
    }

    /**
     * Creates a [Table]Selection class for each table found in $dbInfo
     * 
     * @access private            
     */
    private function createSelectionClasses(){
      foreach($this->inventory as $item){
        $tableName = array_search($item->name, $this->config->bllTables);
        $fileName = $this->config->dir('bll') . '/_selection/'.ucwords(str_replace(' ', '',$item->name)).'Selection.php';
        if(!file_exists($fileName)){
          file_put_contents($fileName, str_replace(array('|::|CLASSNAME|::|','|::|TABLENAME|::|'), array(ucwords(str_replace(' ', '',$item->name)), $tableName), $this->selectionTemplate));
        }
      }
    }
    
    /**
     * Creates a [Table]Collection class for each table found in $dbInfo
     * 
     * @access private            
     */
    private function createCollectionClasses(){
      foreach($this->inventory as $item){
        $tableName = array_search($item->name, $this->config->bllTables);
        $fileName = $this->config->dir('bll') . '/_collection/'.ucwords(str_replace(' ', '',$item->name)).'Collection.php';
        if(!file_exists($fileName)){
          file_put_contents($fileName, str_replace(array('|::|CLASSNAME|::|','|::|TABLENAME|::|'), array(ucwords(str_replace(' ', '',$item->name)), $tableName), $this->collectionTemplate));
        }
      }
    }
  }
?>
