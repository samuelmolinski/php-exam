<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpletest/autorun.php';
require_once ABSPATH .'model/user.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_User_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_User_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing User_Model object creation/desturction</h3>");
		$userM1 = new User_Model();
		$this->assertNotNull($userM1, "Creating User_Model");
		$userM1 = null;
		$this->assertNull($userM1, "Destroying User_Model");

		echo("<h3>Testing User_Model for single value assignment</h3>");
		//Test for single value assignment
        $userM2 = new User_Model;
        $userM2->username = 'Your Momma';
        $this->assertEqual($userM2->username, 'Your Momma', 'Test for single value assignment');
        $userM2 = null;
		
		echo("<h3>Testing User_Model Equality and Transitive property</h3>");
		//Testing Equality property
		$attr = array("username" => "YourMomma", "email" => "YourMomma@hotmail.com", 
					"password" => "spencer", "typeuser" => "2", "active" => "1");
		$userM3 = new User_Model($attr);
		$userM4 = new User_Model($attr);
		$this->assertEqual($userM3, $userM4, "Equality");
		$userM5 = $userM4;
		$this->assertEqual($userM3, $userM5, "Transitive Equality");
    }
        
}

?>
