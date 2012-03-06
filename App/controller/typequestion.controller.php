<?php

require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Typequestion_Controller extends DAO{
        
    public $typequestion;

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->typequestion = new Typequestion_Model($param);
		} else {
			$this->typequestion = new Typequestion_Model();
		}
	}

	public function actionInsert() {
		$this->table = TB_TYPEQUESTION;
		$this->fields = "chr_nametypequestion, chr_description, ";
		$this->values = "'" . $this->typequestion->name . 
						"','" . $this->typequestion->description . "'";

		$t = $this->insert();
		//update with the retrived id
		$dao = $this->getDAO();
		$this->typequestion->id = $this->id = $dao->lastInsertId();
	}

	public function actionUpdate() {
		$this->table = TB_TYPEQUESTION;
		$this->fields =   " chr_nametypequestion = '" . $this->typequestion->name . 
						"', chr_description = '" . $this->typequestion->description . "'";
		
		$this->where = "id_typequestion = '". $this->typequestion->id . "'";
		$this->update();
	}

	public function actionList() {
		$this->table = TB_TYPEQUESTION;
		$this->fields = "chr_nametypequestion, chr_description";
		$this->asc = "id_typequestion";
		$this->limit = 20;

		//returning values as a single object or an array of those objects
		return Utility::formatArraySingle($this->select(), 'Typequestion_Model');		
	}

	public function actionSearch($search) {
		$query_default = array('table' => TB_TYPEQUESTION, 'fields' => "*", 'asc' => "chr_nametypequestion", 'where' => "id_typequestion", 'like' => "*", 'limit' => "20");
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
		return Utility::formatArraySingle($this->select(), 'Typequestion_Model');
		
	}

	public function actionDelete($id) {
		$this->table = TB_TYPEQUESTION;
		$this->where = "id_typequestion = $id";

		$this->delete();
	}
        
}

?>