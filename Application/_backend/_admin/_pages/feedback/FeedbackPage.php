<?php
  namespace Application\_backend\_admin\_pages\feedback;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  
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
      $this->mongodb->switchCollection('feedback');
      $recent_rst = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array("read" => 0, "type" => "testimonial")), $this->mongoGen->sortStage(array("date" => -1))));
      $past_rst = $this->mongodb->aggregateDocs(array($this->mongoGen->matchStage(array("read" => 1, "type" => "testimonial")), $this->mongoGen->sortStage(array("date" => -1))));
      $recent_posts = foo(new MongoAccessLayer('feedback'))->joinCollectionsByID($recent_rst['result'], 'clients', 'client_id');
      $past_posts = foo(new MongoAccessLayer('feedback'))->joinCollectionsByID($past_rst['result'], 'clients', 'client_id');
      $this->setDisplayVariables('RECENT_POSTS', $recent_posts);
      $this->setDisplayVariables('PAST_POSTS', $past_posts);
    }

    /**
     * Mark a post as read
     *    
     * mixed array params
     * @access public
     */
    public function markAsRead($params){
      if($this->isAdminUser()){
        foo(new MongoAccessLayer('feedback'))->saveDocEntry(array('read' => 1), $params['_id']);
      }
    }

    /**
     * Delete a post
     *    
     * mixed array params
     * @access public
     */
    public function deletePost($params){
      if($this->isAdminUser()){
        foo(new MongoAccessLayer('feedback'))->deleteDocEntry($params['_id']);
      }
    }
  }
?>