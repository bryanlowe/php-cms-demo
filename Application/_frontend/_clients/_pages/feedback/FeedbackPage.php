<?php
  namespace Application\_frontend\_clients\_pages\feedback;
  use Application\_frontend\Frontend as Frontend;
  use Framework\_engine\_core\Email as Email;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;
    
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
      $this->source = "client-templates";
      parent::__construct();
    }
    
    /**
     * Initialize FeedbackPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_clients/feedback/scripts.js');
      $this->setTitle('CEM Dashboard - Submit Feedback');
      $this->setTemplate('feedback/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $feedbackForm = foo(new FormGenerator($this->config->dir($this->source).'/feedback/feedback_form.json'))->getFormHTML();
      $this->setDisplayVariables('FEEDBACK_FORM', $feedbackForm);
      $this->mongodb->switchCollection('projects');
      $pipeline = array(
        $this->mongoGen->matchStage(array("client_id" => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'])),
        $this->mongoGen->projectStage(array("project_tag" => 1, "project_date" => 1)),
        $this->mongoGen->sortStage(array("project_date" => -1))
      );
      $projects = $this->mongodb->aggregateDocs($pipeline);
      $maxProjects = count($projects['result']);
      for($i = 0; $i < $maxProjects; $i++){
        $projects['result']['project_date'] = date('m-d-Y H:ia EST', $projects['result']['project_date']);
      }
      $this->setDisplayVariables('PROJECTS', $projects['result']);
    }

    /**
     * Saves a doc to the database
     *
     * @param mixed array $params    
     * @access public
     */
    public function saveEntry($params){
      $params['doc']['_id'] = '';
      $params['doc']['collection'] = "feedback";
      if($params['doc']['project_id'] != ''){
        $this->mongodb->switchCollection('projects');
        $project = $this->mongodb->getDocument(array('_id' => new \MongoId($params['doc']['project_id'])));
        $projectDesc = '<div><p><strong>This concerns a '.$project['project_tag'].' project. This project was last updated '.$project['project_date'].'.</strong></p><p>Project Description: '.$project['project_description'].'</p></div>';
        $params['doc']['values']['description'] = $projectDesc.'<p>Feedback: '.$params['doc']['values']['description'].'</p>';
      } else {
        $params['doc']['values']['description'] = '<p>'.$params['doc']['values']['description'].'</p>';
      }
      $params['doc']['values']['client_id'] = ($params['doc']['anonymous'] == 1) ? $_SESSION[$this->config->sessionID]['CLIENT_INFO']['_id'] : new \MongoId();
      $params['doc']['values']['date'] = date("U");
      $params['doc']['values']['read'] = 0;
      $params['doc']['values']['type'] = 'testimonial';
      parent::saveEntry($params);
      $to = array('email' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['email'], 'name' => $_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name']);
      $from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $reply = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $subject = 'Thank you for your feedback!';
      $message = array('body' => 'Your feedback has been recieved. We look forward to hearing from you again!', 'altbody' => 'Your feedback has been recieved. We look forward to hearing from you again!');
      foo(new Email($to, $from, $reply, $subject, $message, $this->config->smtpInfo))->sendEmail();

      $cem_to = array('email' => 'amie@contentequalsmoney.com', 'name' => 'Amie Marse');
      $cem_from = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $cem_reply = array('email' => 'dashboard@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $cem_subject = 'New Feedback Submission From: '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].', Date: '.$params['doc']['values']['date'];
      $messageBody = '<p>You have recieved feedback from '.$_SESSION[$this->config->sessionID]['CLIENT_INFO']['client_name'].'.</p><p>Please <a href="https://dashboard.contentequalsmoney.com/admin" target="_blank">login</a> for more details.</p>';
      $cem_message = array('body' => $messageBody, 'altbody' => $messageBody);
      foo(new Email($cem_to, $cem_from, $cem_reply, $cem_subject, $cem_message, $this->config->smtpInfo))->sendEmail();
    }
  }
?>