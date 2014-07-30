<?php
	$_SERVER['DOCUMENT_ROOT'] = '/var/www/vhosts/dashboard.contentequalsmoney.com/httpdocs';
	require_once($_SERVER['DOCUMENT_ROOT'].'/Application/connect.php');
	use Framework\_widgets\MongoSaver\_engine\_core\MongoDumper as MongoDumper;
	/**
	 * Creates a MongoDB dump of the main database into the _dump folder
	 */
	$dumper = new MongoDumper($_SERVER['DOCUMENT_ROOT'].'/Utilities/_mongosaver/_dump');
	$dumper->run($config->mongodbname, true);
	deleteBackup(strtotime('-2 weeks'));

	function deleteBackup($timestamp){
		$backupFiles = glob($_SERVER['DOCUMENT_ROOT']."/Utilities/_mongosaver/_dump/*.zip");
	    foreach($backupFiles as $file){
	        $temp = explode('_',str_replace(array($_SERVER['DOCUMENT_ROOT']."/Utilities/_mongosaver/_dump/",'.zip'), array('',''), $file));
	        if($temp[1] < $timestamp){
	        	unlink($file);
	        }
	    }
	}
?>