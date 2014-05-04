<?php
  require_once(dirname(__FILE__) . '/connect.php');
  use Framework\_engine\_core\MVC as MVC;

  /**
   * Class: Controller
   *    
   * Takes in the URI and determines which class will handle the request
   */
  class Controller extends MVC{

    /**
     * An assoc array of URI directories and classes, separated by namespace descriptions
     *    
     * @var assoc array $pages
     * @access public
     * @static
     */
    public static $pages = array(
                                'clients' => array(
                                 '/' => array('dir' => 'home', 'class' => 'HomePage'),
                                 '/account' => array('dir' => 'account', 'class' => 'AccountPage'),
                                 '/feedback' => array('dir' => 'feedback', 'class' => 'FeedbackPage'),
                                 '/invoices' => array('dir' => 'invoices', 'class' => 'InvoicesPage'),
                                 '/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/logout' => array('dir' => 'logout', 'class' => 'LogoutPage'),
                                 '/orders' => array('dir' => 'orders', 'class' => 'OrdersPage'),
                                 '/projects' => array('dir' => 'projects', 'class' => 'ProjectsPage')),

                                'writers' => array(
                                 '/writers' => array('dir' => 'home', 'class' => 'HomePage'),
                                 '/writers/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/writers/logout' => array('dir' => 'logout', 'class' => 'LogoutPage')),

                                'admin' => array(
                                 '/admin' => array('dir' => 'home', 'class' => 'HomePage'),
                                 '/admin/appointments' => array('dir' => 'appointments', 'class' => 'AppointmentsPage'),
                                 '/admin/clients' => array('dir' => 'clients', 'class' => 'ClientsPage'),
                                 '/admin/feedback' => array('dir' => 'feedback', 'class' => 'FeedbackPage'),
                                 '/admin/invoices' => array('dir' => 'invoices', 'class' => 'InvoicesPage'),
                                 '/admin/preview-invoices' => array('dir' => 'preview_invoices', 'class' => 'InvoicesPage'),
                                 '/admin/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/admin/logout' => array('dir' => 'logout', 'class' => 'LogoutPage'),
                                 '/admin/orders' => array('dir' => 'orders', 'class' => 'OrdersPage'),
                                 '/admin/projects' => array('dir' => 'projects', 'class' => 'ProjectsPage'),
                                 '/admin/preview-projects' => array('dir' => 'preview_projects', 'class' => 'ProjectsPage'),
                                 '/admin/settings' => array('dir' => 'settings', 'class' => 'SettingsPage'),
                                 '/admin/users' => array('dir' => 'users', 'class' => 'UsersPage'))
                                );
    
    /**
     * Launches loadPage() and returns the resulting Page class
     * 
     * @return Page 
     * @access public
     */
    public function getPage(){
      return $this->loadPage();
    }
    
    /**
     * Attempts to launch a Page class based on the URI request collected
     * 
     * @return Page $page 
     * @access private
     */
    private function loadPage(){        
      $path = $this->uri->getPath(); 
      $type = $this->uri->path[0];
      if($type == "admin" || $type == "writers"){  
        $page = $this->config->getNamespace($type) . '\\' . self::$pages[$type][$path]['dir'] . '\\' . self::$pages[$type][$path]['class'];  
      } else {
        $page = $this->config->getNamespace('clients') . '\\' . self::$pages['clients'][$path]['dir'] . '\\' . self::$pages['clients'][$path]['class'];  
      }

      if($page){           
        return new $page();
      } else {
        die('This page not found!');
      }
    }
  }

  foo(new Controller())->execute();
?>
