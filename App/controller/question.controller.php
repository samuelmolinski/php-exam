<?php

require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Question_Controller extends DAO{
        
    public $question;

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->question = new Question_Model($param);
		} else {
			$this->question = new Question_Model();
		}
	}

	public function actionInsert() {

		$this->table = TB_QUESTION;
		$this->fields = "int_id_typequestion, txt_question, chr_versionphp, " .
						"bln_depreciated, flo_difficulty, int_flagged, " .
						"int_id_topic, bln_eval, txt_eval, txt_explanation, " .
						"int_id_author";
		$this->values = "'" . $this->question->id_typequestion . 
						"','" . $this->question->question . 
						"','" . $this->question->versionphp . 
						"','" . $this->question->depreciated . 
						"','" . $this->question->difficulty . 
						"','" . $this->question->flagged . 
						"','" . $this->question->id_topic . 
						"','" . $this->question->bln_eval . 
						"','" . $this->question->eval .
						"','" . $this->question->explaination . 
						"','" . $this->question->id_author . "'";

		$t = $this->insert();
		//update with the retrived id
		$dao = $this->getDAO();
		$this->question->id = $this->id = $dao->lastInsertId();
	}

	public function actionUpdate() {
		$this->table = TB_QUESTION;
		$this->fields =   " int_id_typequestion  = '" . $this->question->id_typequestion . 
						"', txt_question = '" . $this->question->question . 
						"', chr_versionphp = '" . $this->question->versionphp . 
						"', bln_depreciated = '" . $this->question->depreciated . 
						"', flo_difficulty = '" . $this->question->difficulty .  
						"', int_flagged = '" . $this->question->flagged . 
						"', bln_eval = '" . $this->question->bln_eval . 
						"', txt_eval = '" . $this->question->eval . 
						"', int_id_topic = '" . $this->question->id_topic . 
						"', txt_explanation = '" . $this->question->explaination . 
						"', int_id_author = '" . $this->question->id_author . "'";
		$this->where = "int_id_question = '". $this->question->id . "'";
		$this->update();
	}

	public function actionList() {
		$this->table = TB_QUESTION;
		$this->fields = "int_id_typequestion, txt_question, chr_versionphp, bln_depreciated, flo_difficulty, int_flagged, int_id_topic, bln_eval, txt_eval, txt_explanation, int_id_author";
		$this->asc = "int_id_typequestion";
		$this->limit = 20;

		//returning values as a single object or an array of those objects
		return Utility::formatArraySingle($this->select(), 'Question_Model');		
	}

	public function actionSearch($search) {
		$query_default = array('table' => TB_QUESTION, 'fields' => "*", 'asc' => "int_id_typequestion", 'where' => "int_id_question", 'like' => "*", 'limit' => "20");
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
		return Utility::formatArraySingle($this->select(), 'Question_Model');
		
	}

	public function actionDelete($id) {
		$this->table = TB_QUESTION;
		$this->where = "int_id_question = $id";

		$this->delete();
	}
        
}

?>