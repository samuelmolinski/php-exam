<?php

require_once ("../model/answer.model.php");
require_once ("../config.php");

class Answer_Controller extends DAO{
        
        private $answer;
        private $controller;
        
        function __construct(){
                $this->answer = new Answer_Model();
        }

        public function actionInsert(){
                $this->answer->id_question = $_POST['id_question'];
                $this->answer->answer = $_POST['answer'];
                $this->answer->correct = md5($_POST['correct']);
                
                $this->table = TB_ANSWERS;
                $this->fields = "int_id_question, txt_answer, bln_correct";
                $this->values = " 
						NULL,
                        '".$this->answer->id_question."', 
                        '".$this->answer->answer."',
                        ".$this->answer->correct."
                ";
                
                $this->insert();
                
        }

        public function actionUpdate(){
                $this->answer->id_question = $_POST['id_question'];
                $this->answer->answer = $_POST['answer'];
                $this->answer->correct = md5($_POST['correct']);
                
                $this->table = TB_ANSWERS;
                $this->fields = "
                        int_id_question  = '".$this->answer->id_question."', 
                        txt_answer = '".$this->answer->answer."',
                        bln_correct = ".$this->answer->correct." 

                ";
                
                $this->update();
        }
        
        public function actionList(){
                $this->table = TB_ANSWERS;
                $this->fields = "int_id_question, txt_answer, bln_correct";
                $this->asc = "int_id_answer";
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionSearch(){
                $this->table = TB_ANSWER;
                $this->fields = "*";
                $this->asc = "int_id_answer";
                $this->where = "int_id_answer";
                $this->like = $_POST['search'];
                $this->limit = 20;
                
                $this->select();
                $this->total();
        }
        
        public function actionDelete(){
                $this->setId($_POST['id']);
                $this->table = TB_ANSWER;
                
                $this->update();
        }
        
}

?>