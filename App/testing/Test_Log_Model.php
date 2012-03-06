<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpletest/autorun.php';
require_once ABSPATH .'model/log.model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_Log_Model extends UnitTestCase {
    
	/* UnitTestCAse looks for the first function with "test" to run
	 * this can not be the same as the class name because if creates a conflict
	 * with the default constructor method that uses the same name as the
	 * function
	 */
    public function test_Log_Model_Integrity() {  
		
		//construction and destruction
		echo("<h3>Testing Log_Model object creation/desturction</h3>");
		$logM1 = new Log_Model();
		$this->assertNotNull($logM1, "Creating Log_Model");
		$logM1 = null;
		$this->assertNull($logM1, "Destroying Log_Model");

		echo("<h3>Testing Log_Model for single value assignment</h3>");
		//Test for single value assignment
        $logM2 = new Log_Model;
        $logM2->id_user = '123';
        $this->assertEqual($logM2->id_user, '123', 'Test for single value assignment');
        $logM2 = null;
		
		echo("<h3>Testing Log_Model Equality and Transitive property</h3>");
		//Testing Equality property		
		$today = date("YmdHis"); 
		$attr = array('id'=> 1, 'id_user'=> 23, 'ref_type'=> 32, 'type_id'=> 43,
				'date'=> $today, 'alteration'=> 'What is the meaning of life?');
		$logM3 = new Log_Model($attr);
		$logM4 = new Log_Model($attr);
		$this->assertEqual($logM3, $logM4, "Equality");
		$logM5 = $logM4;
		$this->assertEqual($logM3, $logM5, "Transitive Equality");
		
    }
        
}
?>