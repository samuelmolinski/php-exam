<?php

require_once (ABSPATH . '/model/answer.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Answer_Controller extends DAO {
        
	public  $answer;

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->answer = new Answer_Model($param);
		} else {
			$this->answer = new Answer_Model();
		}
	}

	public function actionInsert() {

		$this->table = TB_ANSWER;
		$this->fields = "int_id_question, txt_answer, bln_correct";
		$this->values = "'" . $this->answer->id_question . 
						"','" . $this->answer->answer . 
						"','" . $this->answer->correct . "'";

		$t = $this->insert();
		//update with the retrived id
		$dao = $this->getDAO();
		$this->answer->id = $this->id = $dao->lastInsertId();
	}

   public function actionUpdate() {
		$this->table = TB_ANSWER;
		$this->fields =   " int_id_question = '" . $this->answer->id_question . 
						"', txt_answer = '" . $this->answer->answer . 
						"', bln_correct = '" . $this->answer->correct . "'";
		$this->where = "int_id_answer = '". $this->answer->id . "'";
		$this->update();
	}

   public function actionList() {
		$this->table = TB_ANSWER;
		$this->fields = "int_id_question, txt_answer, bln_correct";
		$this->asc = "int_id_question";
		$this->limit = 20;

		//returning values as a single object or an array of those objects
		return Utility::formatArraySingle($this->select(), 'Answer_Model');		
	}

	public function actionSearch($search) {
		$query_default = array('table' => TB_ANSWER, 'fields' => "*", 'asc' => "int_id_question", 'where' => "int_id_answer", 'like' => "*", 'limit' => "20");
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
		return Utility::formatArraySingle($this->select(), 'Answer_Model');

	}

	public function actionDelete($id) {
		$this->table = TB_ANSWER;
		$this->where = "int_id_answer = $id";

		$this->delete();
	}
        
}

?>