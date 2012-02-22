<?PHP

require_once ("../model/topic.model.php");
require_once ("../config.php");

class Topic_Controller extends DAO{
        
        private $topic;
        private $controller;
        
        function __construct(){
                $this->topic = new Topic_Model();
        }

        public function actionInsert(){
				$this->topic->setName($_POST['name']);
                $this->topic->setDescription($_POST['description']);
                
                $this->table = TB_TOPIC;
                $this->fields = "chr_name, txt_description";
                $this->values = " 
						NULL,
                        '".$this->topic->getName()."',
						'".$this->topic->getDescription()."'
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
				$this->topic->setName($_POST['name']);
                $this->topic->setDescription($_POST['description']);
                
                $this->table = TB_TOPIC;
                $this->fields = "
						chr_name = '".$this->topic->getName()."',
                        txt_description = '".$this->topic->getDescription()."'
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_TOPIC;
                $this->fields = "chr_name, txt_description";
                $this->asc = "int_id_topic";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_TOPIC;
                $this->fields = "*";
                $this->asc = "int_id_topic";
                $this->where = "int_id_topic";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_TOPIC;
                
                $this->delete();
        }
        
}

?>