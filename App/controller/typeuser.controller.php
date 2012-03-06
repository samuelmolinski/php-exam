<?php

require_once (ABSPATH . '/model/typeuser.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class Typeuser_Controller extends DAO{
        
    public $typeuser;

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->typeuser = new Typeuser_Model($param);
		} else {
			$this->typeuser = new Typeuser_Model();
		}
	}

	public function actionInsert() {
		$this->table = TB_TYPEUSER;
		$this->fields = "chr_nametypeuser, chr_description";
		$this->values = "'" . $this->typeuser->name . 
						"','" . $this->typeuser->description . "'";

		$t = $this->insert();
		//update with the retrived id
		$dao = $this->getDAO();
		$this->typeuser->id = $this->id = $dao->lastInsertId();
	}

	public function actionUpdate() {
		$this->table = TB_TYPEUSER;
		$this->fields =   "chr_nametypeuser = '" . $this->typeuser->name . 
						"', chr_description = '" . $this->typeuser->description . "'";
		
		$this->where = "int_id_typeuser = '". $this->typeuser->id . "'";
		$this->update();
	}

	public function actionList() {
		$this->table = TB_TYPEUSER;
		$this->fields = "chr_nametypeuser, chr_description";
		$this->asc = "int_id_typeuser";
		$this->limit = 20;

		//returning values as a single object or an array of those objects
		return Utility::formatArraySingle($this->select(), 'Typeuser_Model');		
	}

	public function actionSearch($search) {
		$query_default = array('table' => TB_TYPEUSER, 'fields' => "*", 'asc' => "chr_nametypeuser", 'where' => "int_id_typeuser", 'like' => "*", 'limit' => "20");
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
		return Utility::formatArraySingle($this->select(), 'Typeuser_Model');
		
	}

	public function actionDelete($id) {
		$this->table = TB_TYPEUSER;
		$this->where = "int_id_typeuser = $id";

		$this->delete();
	}
        
}

?>