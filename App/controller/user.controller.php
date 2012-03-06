<?php

require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class User_Controller extends DAO {

	public $user;

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		if (is_array($param)) {
			$this->user = new User_Model($param);
		} else {
			$this->user = new User_Model();
		}
	}

	public function actionInsert() {

		$this->table = TB_USER;
		$this->fields = "chr_email, chr_password, chr_username, int_id_typeuser, bln_active";
		$this->values = "'" . $this->user->email . 
						"','" . $this->user->password . 
						"','" . $this->user->username . 
						"','" . $this->user->typeuser . 
						"','" . $this->user->active . "'";

		$t = $this->insert();
		//update with the retrived id
		$dao = $this->getDAO();
		$this->user->id = $this->id = $dao->lastInsertId();
	}

	public function actionUpdate() {
		$this->table = TB_USER;
		$this->fields =   " chr_username  = '" . $this->user->username . 
						"', chr_email = '" . $this->user->email . 
						"', chr_password = '" . $this->user->password . 
						"', int_id_typeuser = '" . $this->user->typeuser . 
						"', bln_active = '" . $this->user->active . "'";
		$this->where = "int_id_user = '". $this->user->id . "'";
		$this->update();
	}

	public function actionList() {
		$this->table = TB_USER;
		$this->fields = "chr_username, chr_email, chr_password, int_id_typeuser, bln_active";
		$this->asc = "chr_username";
		$this->limit = 20;

		//returning values as a single object or an array of those objects
		return Utility::formatArraySingle($this->select(), 'User_Model');		
	}

	public function actionSearch($search) {
		$query_default = array('table' => TB_USER, 'fields' => "*", 'asc' => "chr_email", 'where' => "int_id_user", 'like' => "*", 'limit' => "20");
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
		return Utility::formatArraySingle($this->select(), 'User_Model');
		
	}

	public function actionDelete($id) {
		$this->table = TB_USER;
		$this->where = "int_id_user = $id";

		$this->delete();
	}

}
?>