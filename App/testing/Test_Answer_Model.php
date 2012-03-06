<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpletest/autorun.php';
require_once ABSPATH .'model/answer.model.php';

/**
 * Description of test_answer
 *
 * @author Blue
 */

//	private $id; //(int)
//	private $id_question; //(int)
//	private $answer; //array(int)
//	private $correct; //array(int)
class Test_Answer_Model extends UnitTestCase {
    
    public function test_Answer_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Answer_Model object creation/desturction</h3>");
		$answerM1 = new Answer_Model();
		$this->assertNotNull($answerM1, "Creating Answer_Model");
		$answerM1 = null;
		$this->assertNull($answerM1, "Destroying Answer_Model");

		echo("<h3>Testing Answer_Model for single value assignment</h3>");
		//Test for single value assignment
        $answerM2 = new Answer_Model;
        $answerM2->id_question = '23';
        $this->assertEqual($answerM2->id_question, '23', 'Test for single value assignment');
        $answerM2 = null;
		
		echo("<h3>Testing Answer_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$attr = array("id_question" => "23", "
			answer" => "Donec nisi arcu, luctus sit amet malesuada et, scelerisque a nisi. ", 
			"correct" => "1");
		$answerM3 = new Answer_Model($attr);
		$answerM4 = new Answer_Model($attr);
		$this->assertEqual($answerM3, $answerM4, "Equality");
		$answerM5 = $answerM4;
		$this->assertEqual($answerM3, $answerM5, "Transitive Equality");
		
    }
        
}
?>