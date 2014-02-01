<?php
  namespace Application\_engine\_sqlform\_forms;
  use Framework\_widgets\SQLForm\_engine\_core\Form as Form;

  /**
   * Class: FeedbackForm
   *    
   * Creates a Selection object based on feedback, creates forms, saves and deletes database entries.
   */  
  class FeedbackForm extends Form{
    public function __construct($objectID = null){
      parent::__construct('feedback', $objectID);
    }

    /**   
     * Saves the form inputs to the table
     *
     * @return string
     * @param mixed array $values
     * @access public
     */
    public function save($values){
      $values['feedback_date'] = date('Y-m-d h:i:s.u');
      return parent::save($values);
    }
  }
?>