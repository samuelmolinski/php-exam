<?php
    //phpinfo();
		
	require_once('config.php');
	require('controller/EnlightenEngine.php');
	
	if ( !isset($ee_did_header) ) {

		$ee_did_header = true;

		global $ee;
		$ee = new EnlightenEngine();
		
		$ee->render('questionBuilder');
		
	}
?>