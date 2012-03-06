<?php

require_once (ABSPATH . '/model/topic.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Topic_Controller extends DAO {
        
        public $topic;
        
        function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->topic = new Topic_Model($param);
		} else {
			$this->topic = new Topic_Model();
		}
	}

        public function actionInsert(){
                
			$this->table = TB_TOPIC;
			$this->fields = "chr_name, txt_description";
			$this->values = "'".$this->topic->name."','".
								$this->topic->description."'";

			$t = $this->insert();
			//update with the retrived id
			$dao = $this->getDAO();
			$this->topic->id = $this->id = $dao->lastInsertId();
                
        }
		
        public function actionUpdate(){                
			$this->table = TB_TOPIC;
			$this->fields = " chr_name = '".$this->topic->name.
							"', txt_description = '".$this->topic->description."'";

			$this->update();
        }
        
        public function actionList(){
			$this->table = TB_TOPIC;
			$this->fields = "chr_name, txt_description";
			$this->asc = "int_id_topic";

		   //returning values as a single object or an array of those objects
			return Utility::formatArraySingle($this->select(), 'Topic_Model');		
		}
        
        public function actionSearch($search){
            $query_default = array('table' => TB_TOPIC, 'fields' => "*", 'asc' => "chr_name", 'where' => "int_id_topic", 'like' => "*", 'limit' => "20");
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
			return Utility::formatArraySingle($this->select(), 'Topic_Model');
		
        }
        
        public function actionDelete($id){
			$this->table = TB_TOPIC;
			$this->where = "int_id_topic = $id";

			$this->delete();
        }
        
}

?>