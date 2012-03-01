<?php

//require_once ("DAO.php");
//require_once ("Funcoes.php");

session_start();
if ( !defined('ABSPATH') ){ define('ABSPATH', dirname(__FILE__) . '/');}

//Database Settings
define("DB_HOST", "localhost");
define("DB_NAME", "phpexam");
define("DB_USER", "admin");
define("DB_PASSWORD", "1234");

//Database Table Settings
define("TB_USER","tb_user");
define("TB_ANSWER","tb_answer");
define("TB_TYPEUSER","tb_typeuser");
define("TB_QUESTION","tb_question");
define("TB_TOPIC","tb_topic");
define("TB_TYPEQUESTION","tb_typequestion");
define("TB_LOG","tb_log");

//Debug Options
define("DEBUG", TRUE);

if (DEBUG) {
	//Error Display
	error_reporting(E_ALL);
	//PDO Options 
	define("PDO_DEBUG", TRUE);
	
	//Test enviroment (another Database for debuging and testing purposes)
	define("TEST_DB_HOST", "localhost");
	define("TEST_DB_NAME", "phpexamtest");
	define("TEST_DB_USER", "admin");
	define("TEST_DB_PASSWORD", "1234");

} else {
	//PDO Options 	
	define("PDO_DEBUG", FALSE);
	error_reporting(E_ALL & ~E_NOTICE);
}

?>