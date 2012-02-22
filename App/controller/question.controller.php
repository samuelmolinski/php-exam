<?php

require_once ("../model/question.model.php");
require_once ("../config.php");

class Question_Controller extends DAO{
        
        private $question;
        private $controller;
        
        function __construct(){
                $this->question = new Question_Model();
        }

        public function actionInsert(){
                $this->question->id_typequestion =$_POST['id_typequestion'];
                $this->question->versionphp = $_POST['versionphp'];
                $this->question->question = $_POST['question'];
				$this->question->depreciated = $_POST['depreciated'];
				$this->question->difficulty = $_POST['difficulty'];
				$this->question->flagged = $_POST['flagged'];
				$this->question->bln_eval = $_POST['bln_eval'];
				$this->question->eval = $_POST['eval'];
				$this->question->id_topic = $_POST['id_topic'];
				$this->question->explanation = $_POST['explanation'];
				$this->question->id_author = $_POST['id_author'];
                
                $this->table = TB_QUESTION;
                $this->fields = "int_id_typequestion, txt_question, chr_versionphp, bln_depreciated, chr_difficult, bln_flagged, int_id_topic, bln_eval, txt_eval, txt_explanation, int_id_author";
                $this->values = " 
						NULL,
                        '".$this->question->id_typequestion."', 
                        '".$this->question->question."',
						'".$this->question->versionphp."',
						".$this->question->depreciated.",
						'".$this->question->difficulty."',
						'".$this->question->flagged."',
						'".$this->question->id_topic."',
						".$this->question->bln_eval.",
						'".$this->question->eval."',
						'".$this->question->explanation."',
                        '".$this->question->id_author."'
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
                $this->question->id_typequestion =$_POST['id_typequestion'];
                $this->question->versionphp = $_POST['versionphp'];
                $this->question->question = $_POST['question'];
				$this->question->depreciated = $_POST['depreciated'];
				$this->question->difficulty = $_POST['difficulty'];
				$this->question->flagged = $_POST['flagged'];
				$this->question->bln_eval = $_POST['bln_eval'];
				$this->question->eval = $_POST['eval'];
				$this->question->id_topic = $_POST['id_topic'];
				$this->question->explanation = $_POST['explanation'];
				$this->question->id_author = $_POST['id_author'];
                
                $this->table = TB_QUESTION;
                $this->fields = "
                        int_id_typequestion  = '".$this->question->id_typequestion."', 
                        txt_question = '".$this->question->question."',
						chr_versionphp = '".$this->question->versionphp."',
                        bln_depreciated = ".$this->question->depreciated.",
						chr_difficulty = '".$this->question->difficulty."',
						int_id_topic = ".$this->question->id_topic.",
						bln_eval = ".$this->question->bln_eval.",
						txt_eval = '".$this->question->eval."',
						txt_explanation = '".$this->question->explanation."',
						int_id_author = '".$this->question->id_author."',
                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_QUESTION;
                $this->fields = "int_id_typequestion, txt_question, chr_versionphp, bln_depreciated, chr_difficult, bln_flagged, int_id_topic, bln_eval, txt_eval, txt_explanation, int_id_author";
                $this->asc = "int_id_question";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_QUESTION;
                $this->fields = "*";
                $this->asc = "int_id_question";
                $this->where = "int_id_question";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_QUESTION;
                
                $this->update();
        }
        
}

?>