<?php

	if ( !defined('ABSPATH') ){ define('ABSPATH', dirname(__FILE__) . '/');}
	
	//required files
	require_once (ABSPATH . '/config.php');
	require_once(ABSPATH . '/inspect.php');
	require(ABSPATH . '/install.php');
    require(ABSPATH . '/model/user.model.php');
    require(ABSPATH . '/controller/user.controller.php');
	
	
	run();
	
	function run() {
		testSetup();
		//testUserModel();
		//testUserController();
	}
	function testSetup() {
		$installer = new DBinstaller;
		
		$installer->buildDB();
	}
	
	function testUserModel() {
		$user = new User_Model;
		
		$user->id = 1234;
		inspect($user->id);
		
		$user = null;
		echo "should be null\n";
		inspect($user->id);
		
		$attr = array("id" => 5678, "username" => "YourMomma", "email" => "YourMomma@hotmail.com");
		inspect($attr);
		$user2 = new User_Model($attr);
		inspect($user2);
	}
	
	
	function testUserController() {
		$userC = new User_Controller;
		inspect($userC);
		$attr = array("id" => 5678, "username" => "YourMomma", "email" => "YourMomma@hotmail.com");		
		//inspect($attr);
		
		/*
		$userC->
				
				$user2 = new User_Model($attr);
				inspect($user2);*/
		
	}
	
?>