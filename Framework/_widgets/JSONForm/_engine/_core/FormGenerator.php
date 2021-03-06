<?php
  namespace Framework\_widgets\JSONForm\_engine\_core;
  use Framework\_engine\_core\Register as Register;
  /**
   * Class: FormGenerator
   *    
   * Creates a form from a JSON object
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
     * JSON string variable
     * 
     * @var    $json
     * @access private            
     */
    private $json = null;

    /**
     * JSON to XML variable
     * 
     * @var    $xml
     * @access private            
     */
    private $xml = null;

    /**
     * XSLT Generated Form
     * 
     * @var $form
     * @access private            
     */
    private $form = null;

    /**
     * Form Name
     * 
     * @var $formName
     * @access private            
     */
    private $formName = null;

    /**   
     * Constructs a FormGenerator object that generates a HTML form
     *
     * @access public
     */
    public function __construct($json = null, $values = array()){
      $this->config = Register::getInstance()->get('config');     
      if($json == null){
        $this->form = "<p>No JSON source entered.</p>";
      } else {
        $type = "";
        if(is_array($json)){
          $type = 'array';
          $this->json = json_decode(json_encode($json));
        } else if(is_object($json)){
          $type = 'object';
          $this->json = json_decode($json);
        } else if(is_file($json)){
          $type = 'file';
          $this->json = json_decode(file_get_contents($json)); 
        } else if(is_string($json)){
          $type = 'string';
          $this->json = json_decode($json);
        }       
  
        if($this->json != null){
          $this->setValues($values);
          $this->jsonToXML();
          $this->createForm();
        } else {
          $this->form = "<p>JSON ".$type." source has bad syntax.</p>";
        }        
      }
    }

    /**   
     * Returns the form HTML string
     *
     * @return string
     * @access public
     */
    public function getFormHTML(){
      return $this->form;
    }

    /**
     * Adds values into the JSON array
     *
     * @access private
     */
    private function setValues($values){
      if(isset($values)){
        foreach($this->json->form as $input){
          if(array_key_exists($input->id, $values)){
            if(is_array($values[$input->id])){
              $input->value = $values[$input->id]['value'];
              if(isset($values[$input->id]['options'])){
                $input->options = json_decode(json_encode($values[$input->id]['options']));
              }
            } else {
              $input->value = $values[$input->id];
            }
          }
        }
      }
    }
  
    /**   
     * Generates XML from JSON Object
     *
     * @access private
     */
    private function jsonToXML(){
      $formXML = new \DOMDocument();
      $formXML->formatOutput = true;
      $formXML->preserveWhiteSpace = false;
      $root = $formXML->createElement('form_config');
      $rootNode = $formXML->appendChild($root);
      $form = $formXML->createElement('form');
      $this->formName = $this->json->id;
      $form->setAttribute('title', ucwords($this->json->id));
      $formInputs = $this->json->form;
      foreach($formInputs as $input){
        $currInput = $formXML->createElement('input');
        foreach($input as $key => $val){
          if($key != "options"){
            $currInput->setAttribute($key, $val);  
          } else {
            $optRoot = $formXML->createElement('options');
            foreach($val as $option){
              $opt = $formXML->createElement('option');
              $optName = $formXML->createElement('name');
              $optName->appendChild($formXML->createTextNode($option->name));
              $optValue = $formXML->createElement('value');
              $optValue->appendChild($formXML->createTextNode($option->value));
              $opt->appendChild($optName);
              $opt->appendChild($optValue);
              $optRoot->appendChild($opt);       
            }
            $currInput->appendChild($optRoot);
          } 
        }
        $form->appendChild($currInput);
      }
      $rootNode->appendChild($form);
      $this->xml = $formXML->saveXML();
    }

    /**   
     * Performs the XSLT transformation and saves it to $this->form
     *
     * @access private
     */
    private function createForm(){
      $xslFile = new \DomDocument;
      $xslFile->load($this->config->dir('jsonform').'/_templates/form.xsl');
      $xmlFile = new \DomDocument;
      $xmlFile->loadXML($this->xml);
      
      $xh = new \XSLTProcessor;
      $xh->setParameter(null,'form_name',$this->formName.'_form');
      $xh->importStyleSheet($xslFile);
      
      $this->form = $xh->transformToXML($xmlFile);
    }
  }
?>