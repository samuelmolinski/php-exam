<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpleTest/autorun.php';
require_once ABSPATH .'model/typequestion.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Typequestion_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_Typequestion_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Typequestion_Model object creation/desturction</h3>");
		$typequestionM1 = new Typequestion_Model();
		$this->assertNotNull($typequestionM1, "Creating Typequestion_Model");
		$typequestionM1 = null;
		$this->assertNull($typequestionM1, "Destroying Typequestion_Model");

		echo("<h3>Testing Typequestion_Model for single value assignment</h3>");
		//Test for single value assignment
        $typequestionM2 = new TypeQuestion_Model;
        $typequestionM2->name = 'Puss \'n boots';
        $this->assertEqual($typequestionM2->name, 'Puss \'n boots', 'Test for single value assignment');
        $typequestionM2 = null;
		
		echo("<h3>Testing typequestion_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$attr = array('id'=> 1, 'name'=> 23, 'description'=> '5.3.8');
		$typequestionM3 = new Typequestion_Model($attr);
		$typequestionM4 = new Typequestion_Model($attr);
		$this->assertEqual($typequestionM3, $typequestionM4, "Equality");
		$typequestionM5 = $typequestionM4;
		$this->assertEqual($typequestionM3, $typequestionM5, "Transitive Equality");
		
    }
        
}
?>