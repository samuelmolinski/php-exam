<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpleTest/autorun.php';
require_once ABSPATH .'model/typeuser.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Typeuser_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_Typeuser_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Typeuser_Model object creation/desturction</h3>");
		$typeuserM1 = new Typeuser_Model();
		$this->assertNotNull($typeuserM1, "Creating Typeuser_Model");
		$typeuserM1 = null;
		$this->assertNull($typeuserM1, "Destroying Typeuser_Model");

		echo("<h3>Testing Typeuser_Model for single value assignment</h3>");
		//Test for single value assignment
        $typeuserM2 = new Typeuser_Model;
        $typeuserM2->description = 'jumble of text';
        $this->assertEqual($typeuserM2->description, 'jumble of text', 'Test for single value assignment');
        $typeuserM2 = null;
		
		echo("<h3>Testing Typeuser_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$attr = array('id'=> 1, 'name'=> 'admin', 'description'=> 23);
		$typeuserM3 = new Typeuser_Model($attr);
		$typeuserM4 = new Typeuser_Model($attr);
		$this->assertEqual($typeuserM3, $typeuserM4, "Equality");
		$typeuserM5 = $typeuserM4;
		$this->assertEqual($typeuserM3, $typeuserM5, "Transitive Equality");
		
    }
        
}
?>