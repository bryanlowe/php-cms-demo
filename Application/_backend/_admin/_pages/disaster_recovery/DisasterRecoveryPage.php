<?php
  namespace Application\_backend\_admin\_pages\disaster_recovery;
  use Application\_backend\Backend as Backend;
  use Framework\_widgets\MongoSaver\_engine\_core\MongoRestorer as MongoRestorer;
  use Framework\_widgets\MongoSaver\_engine\_core\MongoDumper as MongoDumper;
  
  /**
   * Class: DisasterRecoveryPage
   *    
   * Handles the Disaster Recovery Page
   */
  class DisasterRecoveryPage extends Backend{

    /**
     * Construct a new DisasterRecoveryPage object
     *    
     * @access public
     */
    public function __construct(){
      $this->source = "admin-templates";
      parent::__construct();
    }
    
    /**
     * Initialize DisasterRecoveryPage Elements
     *    
     * @access public
     */
    public function init(){
      parent::init();
      $this->addJS('_common/jquery.tablesorter.min.js');
      $this->addJS('_admin/disaster-recovery/scripts.min.js');
      $this->setTemplate('disaster-recovery/main.html');
      $this->setTitle('CEM Dashboard - Disaster Recovery');
    }

    /**
     * Gathers all the page elements
     *              
     * @access protected   
     */
    protected function assemblePage(){   
      parent::assemblePage();   
      $backup = array();
      $backupFiles = glob($this->config->root."/Utilities/_mongosaver/_dump/*.zip");
      usort($backupFiles, function($a, $b){
        if($a==$b) return 0;
        return $a < $b ? 1 : -1;
      });
      foreach($backupFiles as $file){
        $temp = explode('_',str_replace(array($this->config->root."/Utilities/_mongosaver/_dump/",'.zip'), array('',''), $file));
        $backup[] = array('database' => $temp[0], 'date' => date('m-d-Y h:ia',$temp[1]).' EST', 'timestamp' => $temp[1]);
      }
      $this->setDisplayVariables('BACKUP_ENTRIES', $backup);
    }     

    /**
     * Reloads the dom elements
     *
     * @param string array $params    
     * @access public
     */
    public function renderPageElement($params){
      if($params['dom_id'] == 'backup_entries'){
        $backup = array();
        $backupFiles = glob($this->config->root."/Utilities/_mongosaver/_dump/*.zip");
        usort($backupFiles, function($a, $b){
          if($a==$b) return 0;
          return $a < $b ? 1 : -1;
        });
        foreach($backupFiles as $file){
          echo $file;
          $temp = explode('_',str_replace(array($this->config->root."/Utilities/_mongosaver/_dump/",'.zip'), array('',''), $file));
          $backup[] = array('database' => $temp[0], 'date' => date('m-d-Y h:ia',$temp[1]).' EST', 'timestamp' => $temp[1]);
        }
        echo $this->twig->render('disaster-recovery/backup-entry.html', array('BACKUP_ENTRIES' => $backup));
      }
    }

    /**
     * Recovers the database using the MongoRestorer class
     *
     * @access public
     */
    public function restoreDatabase($params){
      $result = foo(new MongoRestorer($params['database'].'_'.$params['timestamp'].'.zip'))->run($params['database']);
      if($result){
        echo json_encode(array('msg' => $params['database'].' has successfully been recovered for date '.date('m-d-Y h:ia',$params['timestamp']).' EST!'));
      } else {
        echo json_encode(array('msg' => $params['database'].' failed to be recovered for date '.date('m-d-Y h:ia',$params['timestamp']).' EST.'));
      }
    }

    /**
     * Backups up the database using the MongoDumper class
     *
     * @access public
     */
    public function dumpDatabase($params){
      $result = foo(new MongoDumper($this->config->root."/Utilities/_mongosaver/_dump"))->run($params['database']);
      if($result){
        echo json_encode(array('msg' => $params['database'].' has successfully been backed up!'));
      } else {
        echo json_encode(array('msg' => $params['database'].' failed to be backed up.'));
      }
    }
  }
?>