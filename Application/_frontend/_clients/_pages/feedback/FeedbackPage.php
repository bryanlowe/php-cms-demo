<?php
  namespace Application\_frontend\_clients\_pages\feedback;
  use Application\_frontend\Frontend as Frontend;
  use Application\_engine\_bll\_collection\ProjectsCollection as ProjectsCollection;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;
  
  /**
   * Class: FeedbackPage
   *    
   * Handles the Order Page
   */
  class FeedbackPage extends Frontend{

    /**
     * Construct a new FeedbackPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "client-templates";
    }
    
    /**
     * Initialize FeedbackPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_clients/feedback/scripts.min.js');
      $this->setTitle('CEM Dashboard - Submit Feedback');
    }
    
    /**
     * Set FeedbackPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('feedback/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $feedbackForm = foo(new Form('feedback'))->getFormHTML();
      $this->setDisplayVariables('FEEDBACK_FORM', $feedbackForm, 'BODY');
      $this->setDisplayVariables('CLIENT_ID', $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id'], 'BODY');
      $projects = foo(new ProjectsCollection())->getByQuery('client_id = '.$this->db->quote($_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_id']));
      $this->setDisplayVariables('PROJECTS', json_encode($projects), 'BODY');
    }
  }
?>