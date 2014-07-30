<?php
	namespace Framework\_widgets\MongoSaver\_engine\_core;
	use Framework\_engine\_core\Register as Register;
/**
 * This class allows you to restore any local mongoDB database, utilizing shell command
 * to do so. If there is an error, please verify that the backup folder has the 
 * correct permissions and this script has execute permissions.
 * 
 * Example:
 *	$restorer = new MongoRestorer("/var/www/html/db-backups");
 *  $restorer->run("mydb", true); // 'true' shows debug info
 *  $restorer->run("mydb2", true); // 'true' shows debug info
 *  $restorer->run("mydb3");
 */

class MongoRestorer {
	private $_BACKUP_FILE = "";
	private $database = "";
	private $debug = false;
	private $config = null;

	public function __construct($backup_file) {
		$this->config = Register::getInstance()->get('config');
		$this->_BACKUP_FILE= $this->config->root . '/Utilities/_mongosaver/_dump/' . $backup_file;
	}

	public function run($database, $debug = false) {
		$this->debug = ($debug === true);
		try {
			$this->database = $database;

			$this->echo_if_debug("<p><strong>Restoring '" . $database . "' from '" . $this->_BACKUP_FILE . "'</strong></p>");

			$this->echo_if_debug("<li>Unzipping files...</li>");
			$this->unzip_files();

			$this->echo_if_debug("<ol>");
			$this->echo_if_debug("<li>Executing mongorestore...</li>");
			$this->mongorestore();

			$this->echo_if_debug("<li>Deleting backup folder...</li>");
			$this->delete_dump_folder();

			$this->echo_if_debug("<li>Complete!</li>");
			$this->echo_if_debug("</ol>");
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}

	private function echo_if_debug($string) {
		if ($this->debug) {
			echo $string;
		}
	}

	private function mongorestore() {
		$command = "mongorestore -u".$this->config->mongouser." -p".$this->config->mongopass . " --authenticationDatabase admin -d ".$this->database." " . str_replace('.zip', '', $this->_BACKUP_FILE);
	    $results = shell_exec($command);
	    $this->echo_if_debug("<ul><li>".$results."</li></ul>");
	}

	private function unzip_files() {
		$database_dump_folder = $this->_BACKUP_FILE; 

		// Initialize archive object
		$zip = new \ZipArchive;
		$zip->open($this->_BACKUP_FILE);

		// Extracting to a directory
		$zip->extractTo(str_replace('.zip', '', $this->_BACKUP_FILE));

		$zip->close();
	}

	private function delete_dump_folder() {
		$files = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator(str_replace('.zip', '', $this->_BACKUP_FILE), \FilesystemIterator::SKIP_DOTS), 
			\RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ( $files as $file ) {
		    $file->isDir() ? rmdir($file) : unlink($file);
		}

		rmdir(str_replace('.zip', '', $this->_BACKUP_FILE));
	}
}
