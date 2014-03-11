<?php
  namespace Application\_engine\_bll\_selection;
  use Framework\_engine\_dal\_mysql\Selection as Selection;

  /**
   * Class: FeedbackSelection
   *    
   * Selects a database record from table feedback and treats it as an object
   */
  class FeedbackSelection extends Selection{
    public function __construct(){
      parent::__construct('feedback');
    }
  }
?>