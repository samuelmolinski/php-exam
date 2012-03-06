<?php

require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Log_Controller extends DAO{
        
        public $log;
        
        function __construct($param = NULL) {		
			parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
			if (is_array($param)) {
				$this->log = new Log_Model($param);
			} else {
				$this->log = new Log_Model();
			}
		}

        public function actionInsert(){                
			$this->table = TB_LOG;
			$this->fields = "int_id_user, int_ref_type, int_type_id, dat_date, chr_alteration";
			$this->values = "'".$this->log->id_user."','".
								$this->log->ref_type."','".
								$this->log->type_id."','".
								$this->log->date."','".
								$this->log->alteration."'";
                
			$t = $this->insert();
			//update with the retrived id
			$dao = $this->getDAO();
			$this->log->id = $this->id = $dao->lastInsertId();
        }

        public function actionUpdate(){                
			$this->table = TB_LOG;
			$this->fields = "int_id_user = '".$this->log->id_user.
					"', int_ref_type = '".$this->log->ref_type.
					"', int_type_id = '".$this->log->type_id.
					"', dat_date = '".$this->log->date.
					"', chr_alteration = '".$this->log->alteration."'";

			$this->where = "int_id_log = '". $this->log->id . "'";
			$this->update();
        }
        
        public function actionList(){
			$this->table = TB_LOG;
			$this->fields = "int_id_user, int_ref_type, int_type_id, dat_date, chr_alteration";
			$this->asc = "int_id_log";
			$this->limit = 20;
                
			//returning values as a single object or an array of those objects
			return Utility::formatArraySingle($this->select(), 'Log_Model');		
		}
        
        public function actionSearch($search){
			$query_default = array('table' => TB_LOG, 'fields' => "*", 'asc' => "int_ref_type", 'where' => "int_id_log", 'like' => "*", 'limit' => "20");
			if (is_array($search)) {
				$query = array_merge($query_default, $search);
			} else {
				$query = $query_default;
				$query['like'] = $search;
			}
			$this->table = $query['table'];
			$this->fields = $query['fields'];
			$this->asc = $query['asc'];
			$this->where = $query['where'];
			$this->like = $query['like'];
			$this->limit = $query['limit'];

			//returning values as a single object or an array of those objects
			return Utility::formatArraySingle($this->select(), 'Log_Model');
        }
        
		public function actionDelete($id) {
			$this->table = TB_LOG;
			$this->where = "int_id_log = $id";

			$this->delete();
		}
        
}

?>