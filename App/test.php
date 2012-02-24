<?php

	if ( !defined('ABSPATH') ){ define('ABSPATH', dirname(__FILE__) . '/');}
	
	//required files
	require_once (ABSPATH . 'testing/AllTests.php');
	
	
	start();
	
	function start() {
            $test = new AllTests();
            $test->run(new HtmlReporter());
	}
	
?>