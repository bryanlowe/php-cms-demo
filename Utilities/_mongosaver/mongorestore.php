<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/Application/connect.php');
	use Framework\_widgets\MongoSaver\_engine\_core\MongoRestorer as MongoRestorer;
	/**
	 * Creates a MongoDB restore of the main database from the _dump folder
	 */
	$restorer = new MongoRestorer('dashboard_1405641741.zip');
	$restorer->run('test_dashboard', true);
?>