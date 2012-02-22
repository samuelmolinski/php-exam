<?php

//require_once ("DAO.php");
//require_once ("Funcoes.php");

session_start();
error_reporting(E_ALL);

if ( !defined('ABSPATH') ){ define('ABSPATH', dirname(__FILE__) . '/');}

define("DB_HOST", "localhost");
define("DB_NAME", "phpExamTest");
define("DB_USER", "admin");
define("DB_PASSWORD", "1234");

define("TB_USER","tb_user");
define("TB_ANSWER","tb_answer");
define("TB_TYPEUSER","tb_typeuser");
define("TB_QUESTION","tb_question");
define("TB_TOPIC","tb_topic");
define("TB_TYPEQUESTION","tb_typequestion");
define("TB_LOG","tb_log");

?>