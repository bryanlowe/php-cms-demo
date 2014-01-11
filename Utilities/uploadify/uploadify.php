<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Application/_config/Config.php');
	/*
	Uploadify
	Copyright (c) 2012 Reactive Apps, Ronnie Garcia
	Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
	*/


	$verifyToken = md5($config->passwords['uploads'] . $_POST['timestamp']);

	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
		$tempFile = $_FILES['Filedata']['tmp_name'];
		// Define a destination
		$targetFolder = $_POST['TARGET_DEST']; // Relative to the root
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
		
		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png','pdf','doc'); // File extensions
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		
		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			echo '1';
		} else {
			echo 'Invalid file type.';
		}
	}
?>