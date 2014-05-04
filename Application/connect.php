<?php
  use Framework\_engine\_core\Register as Register;
  use Framework\_engine\_db\_mysql\DB as MYSQL;
  use Framework\_engine\_db\_mongo\DB as MONGO;

  set_time_limit(0);
  session_start();
  date_default_timezone_set('EST5EDT');

  error_reporting(E_ALL & ~E_NOTICE);

  require_once($_SERVER['DOCUMENT_ROOT'] .'/Utilities/vendor/twig/twig/lib/Twig/Autoloader.php');
  Twig_Autoloader::register();

  require_once($_SERVER['DOCUMENT_ROOT'] . '/Application/_config/Config.php');
  ini_set('include_path', $config->root.'/');
  
  /**
   * Instantiates the LOGGED_IN variable
   */
  if(!isset($_SESSION[$config->sessionID]['LOGGED_IN'])){
    $_SESSION[$config->sessionID]['LOGGED_IN'] = false;
  }

  /**
   * Launches a class
   * @param string $class
   */
  function class_autoloader($className){
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require $fileName; 
  }

  /**
   * Registers the class launcher
   */
  spl_autoload_register('class_autoloader');

  /**
   * Allows the instantiation of a class object without storing it
   * @return class object
   * @param class object declaration (Ex: new Controller())
   */
  function foo($foo) {return $foo;}

  /**
   * Registers site config and database instances
   */
  Register::getInstance()->set('config', $config);
  Register::getInstance()->set('db', new MYSQL($config->dsn,$config->dbuser,$config->dbpass));
  Register::getInstance()->set('mongodb', new MONGO($config->mongohost,$config->mongouser,$config->mongopass,$config->mongodbname));
?>