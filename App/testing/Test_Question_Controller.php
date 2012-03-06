<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpletest/autorun.php';
require_once ABSPATH . 'controller/question.controller.php';
require_once ABSPATH . 'model/question.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_question
 *
 * @author Blue
 */
class Test_Question_Controller extends UnitTestCase {

	public function test_Question_Controller_Integrity() {
		
		echo("<h3>Testing Question_Controller object creation/desturction</h3>");
		$questionC1 = new Question_Controller();
		$this->assertNotNull($questionC1, "Creating question.controller");
		$questionC1 = null;
		$this->assertNull($questionC1, "Destroying question.controller");

		$attr = array('id'=> 1, 'id_typequestion'=> 23, 
					'versionphp'=> '5.3.8', 'question'=> 'What is the meaning of life?', 
					'depreciated'=> 0, 'difficulty'=> 1.4, 'flagged'=> 8, 
					'bln_eval'=> TRUE, 'eval'=> 'code', 'id_topic'=> 12, 
					'explaination'=> '42', 'id_author'=> 13);
		$questionC1 = new Question_Controller($attr);
		//DO NOT MODIFY $questionC1 BELOW THIS LINE: $questionC1 will be static for comparision 
		
		$questionM1 = new Question_Model($attr);
		$this->assertEqual($questionC1->question, $questionM1, "Question.controller->question and Question.Model are equal after construction");
		//DO NOT MODIFY $questionM1 BELOW THIS LINE: $questionM1 will be static for comparision

		echo("<h3>Testing Question_Controller->actionInsert & Question_Controller->actionSearch</h3>");
		$questionC1->actionInsert();
		$questionC2 = new Question_Controller();
		$questionC2->actionInsert();
		$questionM2 = $questionC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["id_typequestion"], $questionM2->id_typequestion, "attr['id_typequestion'] = to questionM2->id_typequestion");
		$this->assertEqual($attr["question"], $questionM2->question, "attr['question'] = to questionM2->question");
		$this->assertEqual($attr["depreciated"], $questionM2->depreciated, "questionM1 = to questionM2");
		$this->assertEqual($attr["difficulty"], $questionM2->difficulty, "questionM1 = to questionM2");
		$this->assertEqual($attr["flagged"], $questionM2->flagged, "questionM1 = to questionM2");
		$this->assertEqual($attr["bln_eval"], $questionM2->bln_eval, "questionM1 = to questionM2");
		$this->assertEqual($attr["eval"], $questionM2->eval, "questionM1 = to questionM2");
		$this->assertEqual($attr["id_topic"], $questionM2->id_topic, "questionM1 = to questionM2");
		$this->assertEqual($attr["explaination"], $questionM2->explaination, "questionM1 = to questionM2");
		$this->assertEqual($attr["id_author"], $questionM2->id_author, "questionM1 = to questionM2");
		//check if works with objects
		$this->assertEqual($questionM1->id_typequestion, $questionM2->id_typequestion, "questionM1->id_typequestion = to questionM2->id_typequestion");
		$this->assertEqual($questionM1->question, $questionM2->question, "questionM1->question = to questionM2->question");
		$this->assertEqual($questionM1->depreciated, $questionM2->depreciated, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->difficulty, $questionM2->difficulty, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->flagged, $questionM2->flagged, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->bln_eval, $questionM2->bln_eval, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->eval, $questionM2->eval, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->id_topic, $questionM2->id_topic, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->explaination, $questionM2->explaination, "questionM1 = to questionM2");
		$this->assertEqual($questionM1->id_author, $questionM2->id_author, "questionM1 = to questionM2");
		
		echo("<h3>Testing Question_Controller->actionUpdate</h3>");
		$attr2 = array('id'=> 1, 'id_typequestion'=> 24, 
					'versionphp'=> '5.3.6', 'question'=> 'Are you serious?', 
					'depreciated'=> 1, 'difficulty'=> 1.3, 'flagged'=> 16, 
					'bln_eval'=> FALSE, 'eval'=> 'more Code', 'id_topic'=> 1, 
					'explaination'=> 'not really', 'id_author'=> 2);
		$questionC2->question->put($attr2);
		$questionC2->actionUpdate();
		$questionM3 = $questionC2->question;
		$this->assertNotEqual($questionM1->id_typequestion, $questionM3->id_typequestion, '$questionM1->id_typequestion, $questionM3->id_typequestion');
		$this->assertNotEqual($questionM1->question, $questionM3->question, '$questionM1->question, $questionM3->question');
		$this->assertNotEqual($questionM1->depreciated, $questionM3->depreciated, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->difficulty, $questionM3->difficulty, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->flagged, $questionM3->flagged, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->bln_eval, $questionM3->bln_eval, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->eval, $questionM3->eval, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->id_topic, $questionM3->id_topic, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->explaination, $questionM3->explaination, "questionM1 = to questionM2");
		$this->assertNotEqual($questionM1->id_author, $questionM3->id_author, "questionM1 = to questionM2");
		$questionC2 = NULL;
		$questionM3 = NULL;
	
		echo("<h3>Testing Question_Controller->actionList</h3>");	
		$questionC3 = new Question_Controller();
		//Do array magic
		$list = $questionC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$questionC3 = NULL;
		
		echo("<h3>Testing Question_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_question = 1", "like" => '', "limit" => '');
		$questionM4 = $questionC1->actionSearch($query);
		$this->assertIsA($questionM4, 'Question_Model');		
		
		echo("<h3>Testing Question_Controller->actionDelete</h3>");
		$questionM4 = $questionC1->actionDelete('1');
		$questionM5 = $questionC1->actionSearch($query);
		//inspect($questionM5);
		$this->assertNull($questionM5);
		
	}

}

?>