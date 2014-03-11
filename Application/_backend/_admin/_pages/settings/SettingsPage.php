<?php
  namespace Application\_backend\_admin\_pages\settings;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
  use Framework\_widgets\SQLForm\_engine\_core as Form;
  
  /**
   * Class: SettingsPage
   *    
   * Handles the Settings Page
   */
  class SettingsPage extends Backend{

    /**
     * Construct a new SettingsPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
    }
    
    /**
     * Initialize SettingsPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/settings/scripts.min.js');
      $this->setTitle('CEM Dashboard - Settings');
      $this->setTemplate('settings/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $form = foo(new FormGenerator(null, $this->config->dir($this->source).'/settings/settings_form.json'))->getFormHTML();
      $this->setDisplayVariables('SETTINGS_FORM', $form);
    }

    /**
     * Creates and deletes BLL Settings files
     *
     * @param assoc array $params
     * @access public
     */
    public function updateBLLForms($params){
      if($this->isAdminUser()){
        if($params['action'] == "CREATE"){
          foo(new Form\FormSettings())->generate();
          foo(new Form\FormGenerator())->generate();
        } else if($params['action'] == "DELETE"){
          $formFiles = glob($_SERVER['DOCUMENT_ROOT']."/Application/_engine/_sqlform/_forms/*Form.php");
          foreach($formFiles as $file){
            unlink($file);
          }
          $settingsFiles = glob($_SERVER['DOCUMENT_ROOT']."/Application/_engine/_sqlform/_settings/*Settings.xml");
          foreach($settingsFiles as $file){
            unlink($file);
          }
        }
      }
    }

    /**
     * Creates and deletes BLL Settings files
     *
     * @param assoc array $params
     * @access public
     */
    public function updateBLLSettings($params){
      if($this->isAdminUser()){
        if($params['action'] == "CREATE"){
          foo(new Form\BLLGenerator())->generate();
        } else if($params['action'] == "DELETE"){
          $selectionFiles = glob($_SERVER['DOCUMENT_ROOT']."/Application/_engine/_bll/_selection/*Selection.php");
          foreach($selectionFiles as $file){
              unlink($file);
          }
          $collectionFiles = glob($_SERVER['DOCUMENT_ROOT']."/Application/_engine/_bll/_collection/*Collection.php");
          foreach($collectionFiles as $file){
              unlink($file);
          }
          unlink($_SERVER['DOCUMENT_ROOT']."/Application/_engine/_bll/_settings/bll_settings.xml");
        }
      }
    } 
  }
?>