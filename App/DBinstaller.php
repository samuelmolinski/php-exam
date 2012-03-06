<?php
require_once (ABSPATH . '/config.php');

class DBinstaller extends PDO{
        
        # atributes / objects for conection
        private $connect = DB_HOST;
        private $db_name = DB_NAME;
        private $root = DB_USER;
        private $pass = DB_PASSWORD;
        private static $conn;

        function __construct($connect='', $root = '', $pass = '') {
        	if ($connect=='') {
                parent::__construct("mysql:dbname=$this->db_name;host=$this->connect", $this->root, $this->pass);
			} else {				
                parent::__construct($connect, $root, $pass);
			}
        }

        public static function getDBinstaller() {
                if (!isset(self::$conn)) {
                        try {
                		//parent::__construct("mysql:dbname=$db_name;host=$connect", $root, $pass);
                        self::$conn = new DBinstaller("mysql:dbname=". DB_NAME .";host=". DB_HOST , DB_USER, DB_PASSWORD);
                }
                                
                        catch (PDOException $e) {
                                throw new Exception("Error to Connect: " .$e->getMessage() . " Code: " .$e->getCode());
                }
           }

                return self::$conn;
        }

        public static function PDO($sql) {
                try {
                        self::$conn = DBinstaller::getDBinstaller();
                        $stm = self::$conn->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (!empty($result)){
                                return $result;
                        }else{
                                return array();
                        }
                        
                }catch (PDOException $e) {
                echo "Exception Error: ".$e->getMessage(). " Code: " .$e->getCode();
                }
                
        }
        
        public function buildDB() {
        	$this->tb_answer();
			$this->tb_log();
			$this->tb_question();
			$this->tb_topic();
			$this->tb_typequestion();
			$this->tb_typeuser();
			$this->tb_user();
        }
		
		private function tb_answer() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_ANSWER.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_ANSWER.'` (
					  `int_id_answer` int(11) NOT NULL auto_increment,
					  `int_id_question` int(11) NOT NULL,
					  `txt_answer` longtext NOT NULL,
					  `bln_correct` tinyint(1) NOT NULL,
					  PRIMARY KEY  (`int_id_answer`)
					);';
			$this->PDO($sql);
		}
		private function tb_log() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_LOG.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_LOG.'` (
					  `int_id_log` int(11) NOT NULL auto_increment,
					  `int_id_user` int(11) NOT NULL,
					  `int_ref_type` int(11) NOT NULL,
					  `int_type_id` int(11) NOT NULL,
					  `dat_date` bigint NOT NULL,
					  `chr_alteration` longtext NOT NULL,
					  PRIMARY KEY  (`int_id_log`)
					);';
			$this->PDO($sql);
		}
		private function tb_question() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_QUESTION.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_QUESTION.'` (
					  `int_id_question` int(11) NOT NULL auto_increment,
					  `int_id_typequestion` int(11) NOT NULL,
					  `txt_question` longtext NOT NULL,
					  `chr_versionphp` varchar(10) NOT NULL,
					  `bln_depreciated` tinyint(1) NOT NULL,
					  `flo_difficulty` float NOT NULL,
					  `int_flagged` int(1) NOT NULL,
					  `bln_eval` tinyint(1) NOT NULL,
					  `txt_eval` longtext,
					  `int_id_topic` int(11) NOT NULL,
					  `txt_explanation` longtext NOT NULL,
					  `int_id_author` int(11) NOT NULL,
					  PRIMARY KEY  (`int_id_question`)
					);';
			$this->PDO($sql);
		}
		private function tb_topic() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_TOPIC.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_TOPIC.'` (
					  `int_id_topic` int(11) NOT NULL auto_increment,
					  `chr_name` varchar(100) NOT NULL,
					  `txt_description` longtext NOT NULL,
					  PRIMARY KEY  (`int_id_topic`)
					);';
			$this->PDO($sql);
		}
		private function tb_typequestion() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_TYPEQUESTION.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_TYPEQUESTION.'` (
					  `id_typequestion` int(11) NOT NULL auto_increment,
					  `chr_nametypequestion` varchar(50) NOT NULL,
					  `chr_description` varchar(500) NOT NULL,
					  PRIMARY KEY  (`id_typequestion`)
					);';
			$this->PDO($sql);
		}
		private function tb_typeuser() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_TYPEUSER.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_TYPEUSER.'` (
					  `int_id_typeuser` int(11) NOT NULL auto_increment,
					  `chr_nametypeuser` varchar(50) NOT NULL,
					  `chr_description` varchar(500) NOT NULL,
					  PRIMARY KEY  (`int_id_typeuser`)
					);';
			$this->PDO($sql);
		}
		private function tb_user() {
			$sql = 'DROP TABLE IF EXISTS `'.TB_USER.'`;
					CREATE TABLE IF NOT EXISTS `'.TB_USER.'` (
					  `int_id_user` int(11) NOT NULL auto_increment ,
					  `chr_username` varchar(60) NOT NULL,
					  `chr_email` varchar(60) NOT NULL,
					  `chr_password` varchar(8) NOT NULL,
					  `int_id_typeuser` int(11) NOT NULL,
					  `bln_active` tinyint(1) NOT NULL,
					  PRIMARY KEY  (`int_id_user`),
					  UNIQUE KEY `chr_email` (`chr_email`)
					);';
			$this->PDO($sql);
		}
                
}

?>