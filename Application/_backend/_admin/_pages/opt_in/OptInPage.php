<?php
  namespace Application\_backend\_admin\_pages\opt_in;
  use Application\_backend\Backend as Backend;
  use Framework\_engine\_dal\_mongo\MongoAccessLayer as MongoAccessLayer;
  use Framework\_widgets\JSONForm\_engine\_core\FormGenerator as FormGenerator;

  /**
   * Class: OptInPage
   *    
   * Handles the Opt-In Page
   */
  class OptInPage extends Backend{

    /**
     * Construct a new OptInPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
    }
    
    /**
     * Initialize OptInPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_admin/opt-in/scripts.min.js');
      $this->setTitle('CEM Dashboard - Opt In Management');
      $this->setTemplate('opt-in/main.html');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $this->mongodb->switchCollection('opt_in');
      $pipeline = array(
        $this->mongoGen->sortStage(array("title" => 1))
      );
      $select_opt = $this->mongodb->aggregateDocs($pipeline);
      $this->setDisplayVariables('SELECT_OPT', $select_opt['result']);
      $optForm = foo(new FormGenerator($this->config->dir($this->source).'/opt-in/opt_form.json'))->getFormHTML();
      $this->setDisplayVariables('OPT_FORM', $optForm);
    }    

    /**
     * Reloads the dom elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'opt_select_container'){
        $this->mongodb->switchCollection('opt_in');
        $pipeline = array(
          $this->mongoGen->sortStage(array("title" => 1))
        );
        $select_opt = $this->mongodb->aggregateDocs($pipeline);
        echo $this->twig->render('opt-in/opt_select.html', array('SELECT_OPT' => $select_opt['result']));
      } else if($params['dom_id'] == 'writer-list'){
        $writers = array();
        if($params['_id'] != 0){
          $this->mongodb->switchCollection('writers');
          $writers = $this->mongodb->getDocuments(array("opt_in" => new \MongoId($params['_id'])),array("writer_name" => 1));
          $writers = iterator_to_array($writers);
          if(count($writers) == 0){
            $writers = array();
          }
        }
        echo $this->twig->render('opt-in/list-group-item.html', array('WRITERS' => $writers));
      }
    }
  }
?>