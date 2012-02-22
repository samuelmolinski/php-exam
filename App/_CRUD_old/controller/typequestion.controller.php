<?PHP

require_once ("../model/typequestions.model.php");
require_once ("../config.php");

class TypeQuestion_Controller extends DAO{
        
        private $typequestion;
        private $controller;
        
        function __construct(){
                $this->typequestion = new Users_Model();
        }

        public function actionInsert(){
                $this->typequestion->setNameTypeQuestion($_POST['nametypequestion']);
                $this->typequestion->setDescription($_POST['description']);
                
                $this->table = TB_TYPEQUESTION;
                $this->fields = "chr_nametypequestion, chr_description";
                $this->values = " 
						NULL,
                        '".$this->typequestion->getNameTypeQuestion()."', 
                        '".$this->typequestion->getDescription()."'
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
                $this->typequestion->setNameTypeQuestion($_POST['nametypequestion']);
                $this->typequestion->setDescription($_POST['description']);
                
                $this->table = TB_TYPEQUESTION;
                $this->fields = "
                        chr_nametypequestion  = '".$this->typequestion->getNameTypeQuestion()."', 
                        chr_description = '".$this->typequestion->getDescription()."'
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_TYPEQUESTION;
                $this->fields = "chr_nametypequestion, chr_description";
                $this->asc = "chr_nametypequestion";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_TYPEQUESTION;
                $this->fields = "*";
                $this->asc = "chr_nametypequestion";
                $this->where = "int_id_typequestion";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_TYPEQUESTION;
                
                $this->delete();
        }
        
}

?>