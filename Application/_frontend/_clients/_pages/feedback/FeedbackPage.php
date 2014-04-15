<?php
  namespace Application\_frontend\_clients\_pages\feedback;
  use Application\_frontend\Frontend as Frontend;
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
      $params['doc']['values']['date'] = date("m-d-Y H:i:s");
      $params['doc']['values']['read'] = 0;
      $params['doc']['values']['type'] = 'testimonial';
      parent::saveEntry($params);
      $to = array('email' => 'mr.bryan.lowe@gmail.com', 'name' => 'Bryan Lowe');
      $from = array('email' => 'bryan.lowe@contentequalsmoney.com', 'name' => 'Bryan Lowe');
      $reply = array('email' => 'info@contentequalsmoney.com', 'name' => 'Content Equals Money');
      $subject = 'Thank you for your feedback!';
      $message = array('body' => 'Your feedback has been recieved. We look forward to hearing from you again!', 'altbody' => 'Your feedback has been recieved. We look forward to hearing from you again!');
      $smtpInfo = array('host' => 'smtp.gmail.com', 'port' => 587, 'auth' => true, 'username' => 'bryan.lowe@contentequalsmoney.com', 'password' => 'drfunk3nst3in');
      foo(new Email($to, $from, $reply, $subject, $message, $smtpInfo))->sendEmail();
    }
  }
?>