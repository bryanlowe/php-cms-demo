<?php
  namespace Application\_backend\_admin\_pages\feedback;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mysql\Selection as Selection;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\FeedbackCollection as FeedbackCollection;
  
  /**
   * Class: FeedbackPage
   *    
   * Handles the Feedback Page
   */
  class FeedbackPage extends Backend{
    /**
     * Feedback entry array
     *
     *@access private
     */
    private $feedbackEntries = array();

    /**
     * Construct a new FeedbackPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
    }
    
    /**
     * Initialize FeedbackPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/feedback/scripts.min.js');
      $this->setTitle('CEM Dashboard - Feedback Management');
      $this->setTemplate('feedback/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->getFeedbackRecords(0);
      $this->setDisplayVariables('RECENT_POSTS', $this->feedbackEntries);
      $this->getFeedbackRecords(1);
      $this->setDisplayVariables('PAST_POSTS', $this->feedbackEntries);
    }
    
    /**
     * Get recent posts
     *    
     * int param read
     * @access private
     */
    private function getFeedbackRecords($read){
      $this->feedbackEntries = array();
      $records = foo(new FeedbackCollection())->getByQuery('read_status = '.$this->db->quote($read), "feedback_date DESC");
      if(($maxRecords = count($records)) > 0){
        for($i = 0; $i < $maxRecords; $i++){
          $client = foo(new ClientsCollection())->getByQuery('client_id = '.$this->db->quote($records[$i]['client_id']));
          $clientName = "Anonymous";
          $company = "";
          if(count($client) > 0){
            $client = array_shift($client);
            $clientName = $client['client_name'];
            $company = '-- '.$client['company'];
          }
          $this->feedbackEntries[] = array('feedback_id' => $records[$i]['feedback_id'], 'read_status' => $records[$i]['read_status'], 'feedback_date' => $records[$i]['feedback_date'], 'feedback_details' => $records[$i]['description'], 'customer_name' => $clientName, 'company' => $company);
        } 
      }
    }

    /**
     * Mark a post as read
     *    
     * mixed array params
     * @access public
     */
    public function markAsRead($params){
      if($this->isAdminUser()){
        $post = foo(new Selection('feedback'))->getByID($params['feedbackID']);
        $post->assign(array('read_status' => 1));
        $post->save();
      }
    }
  }
?>