<?PHP

require_once ("../model/typeuser.model.php");
require_once ("../config.php");

class TypeUser_Controller extends DAO{
        
        private $typeuser;
        private $controller;
        
        function __construct(){
                $this->typeuser = new Users_Model();
        }

        public function actionInsert(){
                $this->typeuser->setDescription($_POST['description']);
                
                $this->table = TB_TYPEUSER;
                $this->fields = "chr_description";
                $this->values = " 
						NULL,
                        '".$this->typeuser->getDescription()."'
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
                $this->typeuser->setDescription($_POST['description']);
                
                $this->table = TB_TYPEUSER;
                $this->fields = "

                        chr_description = '".$this->typeuser->getDescription()."'
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_TYPEUSER;
                $this->fields = "chr_description";
                $this->asc = "int_id_typeuser";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_TYPEUSER;
                $this->fields = "*";
                $this->asc = "int_id_typeuser";
                $this->where = "int_id_typeuser";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_TYPEUSER;
                
                $this->delete();
        }
        
}

?>