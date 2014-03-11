<?php 
  namespace Framework\_widgets\SQLForm\_engine\_core;
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  
  /**
   * Class: Form
   *    
   * This class controls form actions suchs as save, delete and validate. Generates the form HTML.
   */
  class Form{

    /**
     * The instance of Selection class object.
     * 
     * @var $item
     * @access protected
     * @static                
     */
    protected static $item = null;

    /**
     * SimpleXMLElement object containing all the the item fields and attributes
     * 
     * @var $itemFields
     * @access protected                
     */
    protected $itemFields = null;

    /**
     * Name of the table used in this form
     * 
     * @var $objectName
     * @access protected                
     */
    protected $objectName = null;

    /**
     * Table id of the form entry
     * 
     * @var $objectID
     * @access protected                
     */
    protected $objectID = null;

    /**
     * Array of require fields
     * 
     * @var $required
     * @access protected                
     */
    protected $required = array();

    /**
     * Array of numeric fields
     * 
     * @var $numeric
     * @access protected                
     */
    protected $numeric = array();
    
    /**   
     * Constructs a Form class object. 
     *
     * @param string objectName
     * @param mixed objectID
     * @access public
     */
    public function __construct($objectName = null, $objectID = null){
      $this->config = Register::getInstance()->get('config');
      $this->db = Register::getInstance()->get('db');
      $this->objectName = $objectName;
      $this->objectID = $objectID;
      self::$item = foo(new Selection($objectName))->getByID($objectID);
      $xml = file_get_contents($this->config->dir('bll') . '/_settings/bll_settings.xml');
      $bll_settings = new \SimpleXMLElement($xml);
      $this->itemFields = $bll_settings->xpath("inventory/item[table='".$objectName."']/feature");
      $this->gatherRequiredFields();
      $this->gatherNumericFields();
    }

    /**   
     * Generates the HTML form
     *
     * @access public
     */
    public function getFormHTML(){
      return $this->createForm();
    }
    
    /**   
     * Gathers the field names of all required fields
     *
     * @access protected
     */
    protected function gatherRequiredFields(){
      foreach($this->itemFields as $value){
        if($value->attributes()->required == 1 && $value->attributes()->primaryKey == 0){
          $this->required[] = (string)$value;
        }
      }
    }
    
    /**   
     * Gathers the field names of all numeric fields
     *
     * @access protected
     */
    protected function gatherNumericFields(){
      foreach($this->itemFields as $value){
        if($value->attributes()->numeric == 1 && $value->attributes()->primaryKey == 0){
          $this->numeric[] = (string)$value;
        }
      }
    }
    
    /**   
     * Gathers the specified field value
     *
     * @return string
     * @param string $field
     * @access public
     * @static
     */
    public static function getInputValue($field){ 
      return self::$item->__get($field[0]->value);
    }
    
    /**   
     * Performs the XSLT transformation and echos it to the browser
     *
     * @access protected
     */
    protected function createForm(){
      $xslFile = new \DomDocument;
    	$xslFile->load($this->config->dir('sqlform').'/_templates/form.xsl');
    	$xmlFile = new \DomDocument;
    	$xmlFile->load($this->config->dir('sqlform-app').'/_settings/'.ucwords(str_replace(' ', '',$this->config->bllTables[$this->objectName])).'Settings.xml');
    	
    	$xh = new \XSLTProcessor;
    	$xh->registerPHPFunctions();
    	$xh->setParameter(null,'form_name',strtolower($this->objectName).'_form');
    	$xh->importStyleSheet($xslFile);
    	
    	return $xh->transformToXML($xmlFile);
    }
    
    /**   
     * Saves the form inputs to the table
     *
     * @return string
     * @param mixed array $values
     * @access public
     */
    public function save($values){
      if(($result = $this->validate($values)) == 'pass'){
        if($this->objectID != null){
          self::$item = foo(new Selection($this->objectName))->getByID($this->objectID);
        } 
        self::$item->setValues($values);
        foo(new Selection($this->objectName))->save(self::$item);
      }
      return $result;
    }

    /**   
     * Deletes the form entry from the table
     *
     * @return string
     * @param string $primaryKey
     * @access public
     */
    public function delete($primaryKey){
      foo(new Selection($this->objectName))->deleteByID($primaryKey);
      if(self::$item->primaryKeySet($primaryKey)){
        return 'Deletion Error';
      }
      return 'Deletion Success';
    }
    
    /**   
     * Validates the form input entries
     *
     * @return string
     * @param mixed array $values
     * @access protected
     */
    protected function validate($values){
      $error = array();
      foreach($values as $key => $val){
         if(in_array($key, $this->required) && ($val == null || !isset($val))){
            $error[] = $key;
         } else if(in_array($key, $this->numeric) && !is_numeric($val)){
            $error[] = $key.':numeric';
         } 
      }
      if(count($error)){
        return 'error@'.implode(',', $error);
      }
      return 'pass'; 
    }

    /**   
     * Validates whether the form values are unique to the database
     *
     * @return string
     * @param mixed array $values
     * @access protected
     */
    protected function validateUnique($values){}
  }
?>