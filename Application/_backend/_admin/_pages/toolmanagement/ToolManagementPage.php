<?php
  namespace Application\_backend\_admin\_pages\toolmanagement;
  use Application\_backend\Backend as Backend;
  use Application\_tools\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: ToolManagementPage
   *    
   * Handles the Tool Management Page
   */
  class ToolManagementPage extends Backend{

    /**
     * Construct a new ToolManagementPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
    }
    
    /**
     * Initialize ToolManagementPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->setTitle('EvTools CMS - Tool Settings');
    }

    /**
     * Set ToolManagementPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set ToolManagementPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('toolmanagement/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $toolForm = foo(new Form('tools'))->getFormHTML();
      $toolAccessForm = foo(new Form('toolaccess'))->getFormHTML();
      $this->setDisplayVariables('TOOL_FORM', $toolForm, 'BODY');
      $this->setDisplayVariables('TOOL_ACCESS_FORM', $toolAccessForm, 'BODY');
    } 

    /**
     * Set ToolManagementPage footer
     *    
     * @access protected
     */
    protected function footer(){
      parent::footer();
      $scripts = file_get_contents($this->config->dir('backend-templates') . '/toolmanagement/scripts.html');
      $this->setDisplayVariables('JS_ACTIONS', $scripts, 'FOOTER');
    }   
  }
?>