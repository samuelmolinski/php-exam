<?

require_once ("DAO.php");
require_once ("Funcoes.php");

session_start();
error_reporting(E_ALL);

define("DATABASE", "localhost");
define("ROOT", "root");
define("PASSWORD", "");

define("TB_USER","tb_user");
define("TB_ANSWER","tb_answer");
define("TB_TYPEUSER","tb_typeuser");
define("TB_QUESTION","tb_question");
define("TB_TOPIC","tb_topic");
define("TB_TYPEQUESTION","tb_typequestion");
define("TB_LOG","tb_log");

?>