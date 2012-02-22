<?PHP

require_once ("../model/log.model.php");
require_once ("../config.php");

class Log_Controller extends DAO{
        
        private $log;
        private $controller;
        
        function __construct(){
                $this->log = new Log_Model();
        }

        public function actionInsert(){
				$this->log->setIdUser($_POST['id_user']);
                $this->log->setDate($_POST['date']);
				$this->log->setAlteration($_POST['alteration']);
                
                $this->table = TB_LOG;
                $this->fields = "int_id_user, dat_date, chr_alteration";
                $this->values = " 
						NULL,
                        '".$this->log->getIdUser()."',
						'".$this->log->getDate()."',
						'".$this->log->getAlteration()."'
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
				$this->log->setIdUser($_POST['id_user']);
                $this->log->setDate($_POST['date']);
				$this->log->setAlteration($_POST['alteration']);
                
                $this->table = TB_LOG;
                $this->fields = "
						int_id_user = '".$this->log->getIdUser()."',
						chr_alteration = '".$this->log->getIdUser()."',
                        dat_date = '".$this->log->getDate()."'
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_LOG;
                $this->fields = "int_id_user, dat_date, chr_alteration";
                $this->asc = "int_id_log";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_LOG;
                $this->fields = "*";
                $this->asc = "int_id_log";
                $this->where = "int_id_log";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_LOG;
                
                $this->delete();
        }
        
}

?>