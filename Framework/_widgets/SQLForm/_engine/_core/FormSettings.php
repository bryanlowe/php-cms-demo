<?php
  namespace Framework\_widgets\SQLForm\_engine\_core;
  use Framework\_engine\_core\Register as Register;
  
  /**
   * Class: FormSettings
   *    
   * This class creates settings files for the BLL forms
   */
  class FormSettings{

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
     * Constructs a FormSettings object that loads the cms settings and the form template
     *
     * @access public
     */
    public function __construct(){
      $this->config = Register::getInstance()->get('config');      
      $this->bll_settings = new \SimpleXMLElement(file_get_contents($this->config->dir('bll').'/_settings/bll_settings.xml'));
    }
    
    /**   
     * Generates the form classes and the cms form settings
     *
     * @access public
     */
    public function generate(){
      $this->generateFormSettings();
    }

    /**   
     * Generates form settings
     *
     * @access private
     */
    private function generateFormSettings(){
      $inventory = $this->bll_settings->xpath("inventory/item[@enabled='1']");
      foreach($inventory as $item){
        $settings = new \DOMDocument();
        $settings->formatOutput = true;
        $settings->preserveWhiteSpace = false;
        $root = $settings->createElement('form_config');
        $rootNode = $settings->appendChild($root);
        $form = $settings->createElement('form');
        $form->setAttribute('title', ucwords($item->name));
        $inputFeatures = $item->xpath("feature[@visible='1']");
        foreach($inputFeatures as $input){
          $formInput = $settings->createElement('input');
          $formInput->setAttribute('order', 1);
          $formInput->setAttribute('type', 'text');
          $formInput->setAttribute('label', $input[0]);
          $formInput->setAttribute('id', $input[0]);

          // Adds the primary key to the form settings
          if($input->attributes()->primaryKey == 1){
            $formInput->setAttribute('type', 'hidden');
            $formInput->setAttribute('class', 'primaryKey');
          }
        
          // Start gathering multiple value options
          if($input->attributes()->inputOptions != ""){
            $options = explode(",", $input->attributes()->inputOptions);
            $maxOptions = count($options);
            if($maxOptions > 0){
              $optRoot = $settings->createElement('options');
              for($optI = 0; $optI < $maxOptions; $optI++){
                $opt = $settings->createElement('option');
                $optName = $settings->createElement('name');
                $optName->appendChild($settings->createTextNode($options[$optI]));
                $optValue = $settings->createElement('value');
                $optValue->appendChild($settings->createTextNode($options[$optI]));
                $opt->appendChild($optName);
                $opt->appendChild($optValue);
                $optRoot->appendChild($opt);
              }
              $formInput->setAttribute('type', 'select');
              $formInput->appendChild($optRoot);
            }
          }
          // End gathering multiple value options
          $form->appendChild($formInput);
        }

        // Start SAVE and DELETE buttons
        $saveBtn = $settings->createElement('input');
        $saveBtn->setAttribute('order', 1);
        $saveBtn->setAttribute('type', 'button');
        $saveBtn->setAttribute('id', "saveBtn");
        $saveBtn->setAttribute('value', "SAVE ENTRY");
        $saveBtn->setAttribute('onclick', "saveEntry('".ucwords(str_replace(' ', '',$item->name))."');");
        $form->appendChild($saveBtn);

        $deleteBtn = $settings->createElement('input');
        $deleteBtn->setAttribute('order', 1);
        $deleteBtn->setAttribute('type', 'button');
        $deleteBtn->setAttribute('id', "deleteBtn");
        $deleteBtn->setAttribute('value', "DELETE ENTRY");
        $deleteBtn->setAttribute('onclick', "deleteEntry('".ucwords(str_replace(' ', '',$item->name))."');");
        $form->appendChild($deleteBtn);
        // End SAVE and DELETE buttons

        $rootNode->appendChild($form);
        $settings->save($this->config->dir('sqlform-app').'/_settings/'.ucwords(str_replace(' ', '',$item->name)).'Settings.xml');
      }
    }
  }
?>