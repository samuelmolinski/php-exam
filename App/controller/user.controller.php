<?php
require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');
require_once (ABSPATH . '/Utility.php');

class User_Controller extends DAO {

	public $user;
	private $controller;

	function __construct($param = NULL) {
		if (is_array($param)) {
			$this->user = new User_Model($param);
		} else {
			$this->user = new User_Model();
		}
		//$this->functions = new Functions();
	}

	public function actionInsert() {

		$this->table = TB_USER;
		$this->fields = "chr_email, chr_password, chr_username, int_id_typeuser, bln_active";
		$this->values = "
                        '" . $this->user->email . "', 
                        '" . $this->user->password . "',
                        '" . $this->user->username . "',
                        '" . $this->user->typeuser . "',
                        '" . $this->user->active . "'";

		$this->insert();
	}

	public function actionUpdate() {

		$this->table = TB_USER;
		$this->fields = "
                        chr_username  = '" . $this->user->username . "', 
                        chr_email = '" . $this->user->email . "',
                        chr_password = '" . $this->user->password . "', 
                        int_id_typeuser = '" . $this->user->typeuser . "'
                        bln_active = '" . $this->user->active . "'
                ";

		$this->update();
	}

	public function actionList() {
		$this->table = TB_CLIENTE;
		$this->fields = "chr_email, chr_username, id_typeuser, bln_active";
		$this->asc = "chr_username";
		$this->limit = 20;

		$this->select();
		$this->total();
	}

	public function actionSearch($search) {
		$query_default = Array('table' => TB_USER, 'fields' => "*", 'asc' => "chr_email", 'where' => "int_id_user", 'like' => "*", 'limit' => "20");
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

		$return = array();
		$list = $this->select(); 
		foreach ($list as $item) {
			$return[] = new User_Model($item);
		}
		$this->total();
		return $return;
	}
	
	public function actionGet($search) {
		$query_default = Array('table' => TB_USER, 'fields' => "*", 'where' => "int_id_user");
		if (is_array($search)) {
			$query = array_merge($query_default, $search);
		} else {
			$query = $query_default;
			$query['where'] = "int_id_user = " . $search;
		}
		$this->table = $query['table'];
		$this->fields = $query['fields'];
		$this->where = $query['where'];

		$list = $this->select(); 
		foreach ($list as $item) {
			$return[] = new User_Model($item);
		}
		$this->total();
		if (count($return)>1) {
			return $return;
		} else {			
			return $return[0];
		}
	}

	public function actionDelete() {
		$this->setId($_POST['id']);
		$this->table = TB_USER;

		$this->update();
	}

}
?>