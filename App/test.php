<?php

	if (!defined('ABSPATH')) {
		define('ABSPATH', dirname(__FILE__) . '/');
	}

	//required files
	require_once (ABSPATH . 'config.php');
	require_once (ABSPATH . 'inspect.php');
	require_once (ABSPATH . 'DBinstaller.php');
	require_once (ABSPATH . 'testing/AllTests.php');

	//$testDB = new DBinstaller(TEST_DB_HOST, TEST_DB_USER, TEST_DB_PASSWORD, TEST_DB_NAME);
	$testDB = new DBinstaller();
	//inspect($testDB);
	
	$testDB->buildDB();

	start();

	function start() {	
		$test = new AllTests();	
        $test->addFile(ABSPATH .'testing/Test_User_Model.php');
        $test->addFile(ABSPATH .'testing/Test_User_Controller.php');
	}

	function installTestDB() {
		//$testDB = new DBinstaller(TEST_DB_HOST, TEST_DB_USER, TEST_DB_PASSWORD, TEST_DB_NAME);

		//inspect($testDB->getDBinstaller());
	}

	function removeTestDB() {

	}

?>