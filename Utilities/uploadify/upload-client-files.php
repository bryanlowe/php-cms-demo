<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Application/_config/Config.php');
	/*
	UploadiFive
	Copyright (c) 2012 Reactive Apps, Ronnie Garcia
	*/


	$verifyToken = md5($config->passwords['uploads'] . $_POST['timestamp']);

	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
		$tempFile = $_FILES['Filedata']['tmp_name'];
		// Define a destination
		$fileName = '';
        $postfix = "_".$_POST['client_id']."_".date('m-d-Y');
        $fileNameParts = explode('.', $_FILES['Filedata']['name']);
        $fileNameParts[0] .= $postfix;
        $fileName = implode('.', $fileNameParts);
        
		$targetFolder = '/Media/_documents/'; // Relative to the root
		$clientFolder = '_clients/'.$_POST['client_id'].'/';
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder . $clientFolder;
		if(!file_exists($targetPath)){
			if(! @mkdir('$targetPath', 0777, $recursive = true)){
			    $mkdirErrorArray = error_get_last();
			    throw new Exception('cant create directory ' .$mkdirErrorArray['message'], 1);
			}
		}
		$targetFile = rtrim($targetPath,'/') . '/' . $fileName;
		
		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png','pdf','doc'); // File extensions
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		
		if (in_array($fileParts['extension'],$fileTypes)) {
			move_uploaded_file($tempFile,$targetFile);
			echo '1';
		} else {
			echo 'Invalid file type. File Types Allowed: .pdf, .doc';
		}
	}
?>