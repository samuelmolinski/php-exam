<?php

require_once (ABSPATH . '/model/user.model.php');
require_once (ABSPATH . '/config.php');
require_once (ABSPATH . '/DAO.php');

class User_Controller extends DAO {
        
        public $user;
        private $controller;
        
        function __construct(){
                $this->user = new User_Model();
                //$this->functions = new Functions();
        }

        public function actionInsert(){
//                $this->user->username = $_POST['username'];
//                $this->user->email = $_POST['email'];
//                $this->user->password = md5($_POST['password']);
//                $this->user->typeuser = $_POST['typeuser']; 
//                $this->user->active = $_POST['active'];
                
                $this->table = TB_USERS;
                $this->fields = "chr_email, chr_password, chr_username, int_id_typeuser, bln_active";
                $this->values = " 
						NULL,
                        '".$this->user->email."', 
                        '".$this->user->password."',
                        '".$this->user->username."',
                        '".$this->user->typeuser."',
                        '".$this->user->active." 
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
//                $this->user->username = $_POST['username'];
//                $this->user->email = $_POST['email'];
//                $this->user->password = md5($_POST['password']);
//                $this->user->typeuser = $_POST['typeuser']; 
//                $this->user->active = $_POST['active'];
                
                $this->table = TB_USERS;
                $this->fields = "
                        chr_username  = '".$this->user->username."', 
                        chr_email = '".$this->user->email."',
                        chr_password = '".$this->user->password."', 
                        int_id_typeuser = '".$this->user->typeuser."'
                        bln_active = '".$this->user->active."'
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_CLIENTE;
                $this->fields = "chr_email, chr_username, id_typeuser, bln_active";
                $this->asc = "chr_username";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_USERS;
                $this->fields = "*";
                $this->asc = "chr_email";
                $this->where = "int_id_user";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_USERS;
                
                $this->update();
        }
        
}

?>