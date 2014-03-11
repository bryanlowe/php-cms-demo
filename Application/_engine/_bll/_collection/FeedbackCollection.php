<?php
  namespace Application\_engine\_bll\_collection;
  use Framework\_engine\_dal\_mysql\Collection as Collection;
  
  /**
   * Class: FeedbackCollection
   *    
   * Collects a set database records from table feedback and treats them as a collection of object
   */
  class FeedbackCollection extends Collection{
    public function __construct(){
      parent::__construct('feedback');
    }
  }
?>