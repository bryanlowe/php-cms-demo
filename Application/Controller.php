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
                                 '/forgot-password' => array('dir' => 'forgot_password', 'class' => 'ForgotPasswordPage'),
                                 '/invoices' => array('dir' => 'invoices', 'class' => 'InvoicesPage'),
                                 '/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/logout' => array('dir' => 'logout', 'class' => 'LogoutPage'),
                                 '/orders' => array('dir' => 'orders', 'class' => 'OrdersPage'),
                                 '/projects' => array('dir' => 'projects', 'class' => 'ProjectsPage'),
                                 '/register' => array('dir' => 'register', 'class' => 'RegisterPage')),

                                'writers' => array(
                                 '/writers' => array('dir' => 'home', 'class' => 'HomePage'),
                                 '/writers/account' => array('dir' => 'account', 'class' => 'AccountPage'),
                                 '/writers/feedback' => array('dir' => 'feedback', 'class' => 'FeedbackPage'),
                                 '/writers/forgot-password' => array('dir' => 'forgot_password', 'class' => 'ForgotPasswordPage'),
                                 '/writers/invoices' => array('dir' => 'invoices', 'class' => 'InvoicesPage'),
                                 '/writers/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/writers/logout' => array('dir' => 'logout', 'class' => 'LogoutPage'),
                                 '/writers/projects' => array('dir' => 'projects', 'class' => 'ProjectsPage'),
                                 '/writers/schedule' => array('dir' => 'schedule', 'class' => 'SchedulePage')),

                                'admin' => array(
                                 '/admin' => array('dir' => 'home', 'class' => 'HomePage'),
                                 '/admin/appointments' => array('dir' => 'appointments', 'class' => 'AppointmentsPage'),
                                 '/admin/clients' => array('dir' => 'clients', 'class' => 'ClientsPage'),
                                 '/admin/client-resources' => array('dir' => 'client_resources', 'class' => 'ClientResourcesPage'),
                                 '/admin/create-invoice' => array('dir' => 'create_invoice', 'class' => 'CreateInvoicePage'),
                                 '/admin/disaster-recovery' => array('dir' => 'disaster_recovery', 'class' => 'DisasterRecoveryPage'),
                                 '/admin/edit-invoice' => array('dir' => 'edit_invoice', 'class' => 'EditInvoicePage'),
                                 '/admin/feedback' => array('dir' => 'feedback', 'class' => 'FeedbackPage'),
                                 '/admin/invoices' => array('dir' => 'invoices', 'class' => 'InvoicesPage'),
                                 '/admin/preview-invoices' => array('dir' => 'preview_invoices', 'class' => 'InvoicesPage'),
                                 '/admin/login' => array('dir' => 'login', 'class' => 'LoginPage'),
                                 '/admin/logout' => array('dir' => 'logout', 'class' => 'LogoutPage'),
                                 '/admin/opt_in' => array('dir' => 'opt_in', 'class' => 'OptInPage'),
                                 '/admin/orders' => array('dir' => 'orders', 'class' => 'OrdersPage'),
                                 '/admin/projects' => array('dir' => 'projects', 'class' => 'ProjectsPage'),
                                 '/admin/preview-projects' => array('dir' => 'preview_projects', 'class' => 'ProjectsPage'),
                                 '/admin/schedule' => array('dir' => 'schedule', 'class' => 'SchedulePage'),
                                 '/admin/users' => array('dir' => 'users', 'class' => 'UsersPage'),
                                 '/admin/writers' => array('dir' => 'writers', 'class' => 'WritersPage'))
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
