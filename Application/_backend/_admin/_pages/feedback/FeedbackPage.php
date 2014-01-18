<?php
  namespace Application\_backend\_admin\_pages\feedback;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\Selection as Selection;
  use Application\_engine\_bll\_collection\ClientsCollection as ClientsCollection;
  use Application\_engine\_bll\_collection\FeedbackCollection as FeedbackCollection;
  
  /**
   * Class: FeedbackPage
   *    
   * Handles the Feedback Page
   */
  class FeedbackPage extends Backend{

    /**
     * Construct a new FeedbackPage object
     *    
     * @access public
     */
    public function __construct(){
      parent::__construct();
      $this->source = "admin-templates";
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
    }

    /**
     * Set FeedbackPage header
     *    
     * @access protected
     */
    protected function header(){
      parent::header();
    }
    
    /**
     * Set FeedbackPage body
     *    
     * @access protected
     */
    protected function body(){
      $this->setBody('feedback/main.html');
      $this->setDisplayVariables('IMAGEPATH', $this->config->dir('images'), 'BODY');
      $recentPosts = $this->getFeedbackRecords(0);
      $this->setDisplayVariables('RECENT_POSTS', $recentPosts, 'BODY');
      $pastPosts = $this->getFeedbackRecords(1);
      $this->setDisplayVariables('PAST_POSTS', $pastPosts, 'BODY');
    }

    /**
     * Get recent posts
     *    
     * int param read
     * @access private
     */
    private function getFeedbackRecords($read){
      $listGroupItem = file_get_contents($this->config->dir('admin-templates') . '/feedback/list-group-item.html');
      $resultStr = "";
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
          $resultStr .= str_replace(array("<!--///FEEDBACK_ID///-->","<!--///READ_STATUS///-->","<!--///POST_DATE///-->","<!--///FEEDBACK_DETAILS///-->","<!--///CUSTOMER_NAME///-->","<!--///COMPANY///-->"), array($records[$i]['feedback_id'],$records[$i]['read_status'],$records[$i]['feedback_date'],$records[$i]['description'],$clientName,$company), $listGroupItem);
        } 
      } else {
        $resultStr .= '<h2 class="no-entries" align="center">No feedback to show</h2>';
      }
      return $resultStr;
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