<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpleTest/autorun.php';
require_once ABSPATH .'model/topic.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Topic_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_Topic_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Topic_Model object creation/desturction</h3>");
		$topicM1 = new Topic_Model();
		$this->assertNotNull($topicM1, "Creating Topic_Model");
		$topicM1 = null;
		$this->assertNull($topicM1, "Destroying Topic_Model");

		echo("<h3>Testing Topic_Model for single value assignment</h3>");
		//Test for single value assignment
        $topicM2 = new Topic_Model;
        $topicM2->name = '123';
        $this->assertEqual($topicM2->name, '123', 'Test for single value assignment');
        $topicM2 = null;
		
		echo("<h3>Testing Topic_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$today = date("YmdHis"); 
		$attr = array('id'=> 1, 'name'=> 'functions', 'description'=> 'everything about functions');
		$topicM3 = new Topic_Model($attr);
		$topicM4 = new Topic_Model($attr);
		$this->assertEqual($topicM3, $topicM4, "Equality");
		$topicM5 = $topicM4;
		$this->assertEqual($topicM3, $topicM5, "Transitive Equality");
		
    }
        
}
?>