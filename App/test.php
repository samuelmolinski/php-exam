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
		
        $test->addFile(ABSPATH .'testing/Test_Answer_Model.php');
        $test->addFile(ABSPATH .'testing/Test_Answer_Controller.php');
		
        $test->addFile(ABSPATH .'testing/Test_Question_Model.php');
        $test->addFile(ABSPATH .'testing/Test_Question_Controller.php');
		
        $test->addFile(ABSPATH .'testing/Test_Topic_Model.php');
        $test->addFile(ABSPATH .'testing/Test_Topic_Controller.php');
		
        $test->addFile(ABSPATH .'testing/Test_Log_Model.php');
        $test->addFile(ABSPATH .'testing/Test_Log_Controller.php');
		
        $test->addFile(ABSPATH .'testing/Test_Typequestion_Model.php');
        $test->addFile(ABSPATH .'testing/Test_Typequestion_Controller.php');
		
        //$test->addFile(ABSPATH .'testing/Test_Typeuser_Model.php');
        //$test->addFile(ABSPATH .'testing/Test_Typeuser_Controller.php');
	}

	function installTestDB() {
		//$testDB = new DBinstaller(TEST_DB_HOST, TEST_DB_USER, TEST_DB_PASSWORD, TEST_DB_NAME);

		//inspect($testDB->getDBinstaller());
	}

	function removeTestDB() {

	}

?>