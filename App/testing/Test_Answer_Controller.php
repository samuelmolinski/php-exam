<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpleTest/autorun.php';
require_once ABSPATH . 'controller/answer.controller.php';
require_once ABSPATH . 'model/answer.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Answer_Controller extends UnitTestCase {

	public function test_Answer_Controller_Integrity() {
		
		echo("<h3>Testing Answer_Controller object creation/desturction</h3>");
		$answerC1 = new Answer_Controller();
		$this->assertNotNull($answerC1, "Creating user.controller");
		$answerC1 = null;
		$this->assertNull($answerC1, "Destroying user.controller");

		$attr = array("id_question" => "23", "answer" => "Donec nisi arcu, luctus sit amet malesuada et, scelerisque a nisi. ", "correct" => "1");
		$answerC1 = new Answer_Controller($attr);
		//DO NOT MODIFY $answerC1 BELOW THIS LINE: $answerC1 will be static for comparision 
		$answerM1 = new Answer_Model($attr);
		$this->assertEqual($answerC1->answer, $answerM1, "Answer.controller->id_question and Answer.Model are equal after construction");
		//DO NOT MODIFY $answerM1 BELOW THIS LINE: $answerM1 will be static for comparision

		echo("<h3>Testing Answer_Controller->actionInsert & Answer_Controller->actionSearch</h3>");
		$answerC1->actionInsert();
		$answerC2 = new Answer_Controller();
		$answerC2->actionInsert();
		$answerM2 = $answerC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["id_question"], $answerM2->id_question, "answerM1 = to answerM2");
		$this->assertEqual($attr["answer"], $answerM2->answer, "answerM1 = to answerM2");
		$this->assertEqual($attr["correct"], $answerM2->correct, "answerM1 = to answerM2");
		//check if works with objects
		$this->assertEqual($answerM1->id_question, $answerM2->id_question, "answerM1 = to answerM2");
		$this->assertEqual($answerM1->answer, $answerM2->answer, "answerM1 = to answerM2");
		$this->assertEqual($answerM1->correct, $answerM2->correct, "answerM1 = to answerM2");
		
		echo("<h3>Testing Answer_Controller->actionUpdate</h3>");
		$attr2 = array("id_question" => "24", "answer" => "DaddyWasHere", "correct" => "3");
		$answerC2->answer->put($attr2);
		$answerC2->actionUpdate();
		$answerM3 = $answerC2->answer;
		$this->assertNotEqual($answerM1->id_question, $answerM3->id_question, "answerM1 != to answerM3");
		$this->assertNotEqual($answerM1->answer, $answerM3->answer, "answerM1 != to answerM3");
		$this->assertNotEqual($answerM1->correct, $answerM3->correct, "answerM1 != to answerM3");
		$answerC2 = NULL;
		$answerM3 = NULL;
		
		echo("<h3>Testing Answer_Controller->actionList</h3>");	
		$answerC3 = new Answer_Controller();
		//Do array magic
		$list = $answerC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$answerC3 = NULL;
		
		echo("<h3>Testing Answer_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_answer = 1", "like" => '', "limit" => '');
		$answerM4 = $answerC1->actionSearch($query);
		$this->assertIsA($answerM4, 'Answer_Model');		
		
		echo("<h3>Testing Answer_Controller->actionDelete</h3>");
		$answerM4 = $answerC1->actionDelete('1');
		$answerM5 = $answerC1->actionSearch($query);
		//inspect($answerM5);
		$this->assertNull($answerM5);
		
	}

}

?>