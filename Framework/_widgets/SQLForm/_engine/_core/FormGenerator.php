<?php
  namespace Framework\_widgets\SQLForm\_engine\_core;
  use Framework\_engine\_core\Register as Register;
  
  /**
   * Class: FormGenerator
   *    
   * This class creates bll form files
   */
  class FormGenerator{

    /**
     * The instance of the Config Class
     * 
     * @var    $config
     * @access private            
     */
    private $config = null;

    /**
     * SimpleXMLElement object with bll_settings.xml loaded
     * 
     * @var $bll_settings
     * @access private            
     */
    private $bll_settings = null;

    /**
     * The contents of the bll form class template
     * 
     * @var $formTemplate
     * @access private            
     */
    private $formTemplate = null;

    /**   
     * Constructs a FormGenerator object that loads the bll settings and the form template
     *
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');      
      $this->bll_settings = new \SimpleXMLElement(file_get_contents($this->config->dir('bll').'/_settings/bll_settings.xml'));
      $this->formTemplate = file_get_contents($this->config->dir('sqlform').'/_templates/bll_form.txt');
    }
    
    /**   
     * Generates the form classes and the bll form settings
     *
     * @access public
     */
    public function generate(){
      $this->generateFormClass();
    }
    
    /**   
     * Generates form classes
     *
     * @access private
     */
    private function generateFormClass(){
      $inventory = $this->bll_settings->xpath("inventory/item[@enabled='1']");
      foreach($inventory as $item){
        $tableName = array_search($item->name, $this->config->bllTables);
        $fileName = $this->config->dir('sqlform-app').'/_forms/'.ucwords(str_replace(' ', '',$item->name)).'Form.php';
        if(!file_exists($fileName)){
          file_put_contents($fileName, str_replace(array('|::|CLASSNAME|::|','|::|TABLENAME|::|'), array(ucwords(str_replace(' ', '',$item->name)), $tableName), $this->formTemplate));
        }
      }
    }
  }
?>