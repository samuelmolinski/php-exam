<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpletest/autorun.php';
require_once ABSPATH .'model/question.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Question_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_Question_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Question_Model object creation/desturction</h3>");
		$questionM1 = new Question_Model();
		$this->assertNotNull($questionM1, "Creating Question_Model");
		$questionM1 = null;
		$this->assertNull($questionM1, "Destroying Question_Model");

		echo("<h3>Testing Question_Model for single value assignment</h3>");
		//Test for single value assignment
        $questionM2 = new Question_Model;
        $questionM2->id_typequestion = '123';
        $this->assertEqual($questionM2->id_typequestion, '123', 'Test for single value assignment');
        $questionM2 = null;
		
		echo("<h3>Testing Question_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$attr = array('id'=> 1, 'id_typequestion'=> 23, 
					'versionphp'=> '5.3.8', 'question'=> 'What is the meaning of life?', 
					'depreciated'=> 0, 'difficulty'=> 1.4, 'flagged'=> 8, 
					'bln_eval'=> TRUE, 'eval'=> 'code', 'id_topic'=> 12, 
					'explaination'=> '42', 'id_author'=> 13);
		$questionM3 = new Question_Model($attr);
		$questionM4 = new Question_Model($attr);
		$this->assertEqual($questionM3, $questionM4, "Equality");
		$questionM5 = $questionM4;
		$this->assertEqual($questionM3, $questionM5, "Transitive Equality");
		
    }
        
}
?>