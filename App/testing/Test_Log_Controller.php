<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpletest/autorun.php';
require_once ABSPATH . 'controller/log.controller.php';
require_once ABSPATH . 'model/log.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_log
 *
 * @author Blue
 */
class Test_Log_Controller extends UnitTestCase {

	public function test_Log_Controller_Integrity() {
		
			
		$today = (string)date("YmdHis"); 
		$today2 = (string)date("YmdHis"); 
		
		echo("<h3>Testing Log_Controller object creation/desturction</h3>");
		$logC1 = new Log_Controller();
		$this->assertNotNull($logC1, "Creating log.controller");
		$logC1 = null;
		$this->assertNull($logC1, "Destroying log.controller");

		$attr = array('id'=> 1, 'id_user'=> 23, 'ref_type'=> 32, 'type_id'=> 43,
				'date'=> $today, 'alteration'=> 'Can you hear me?');
		$logC1 = new Log_Controller($attr);
		//DO NOT MODIFY $logC1 BELOW THIS LINE: $logC1 will be static for comparision 
		
		$logM1 = new Log_Model($attr);
		$this->assertEqual($logC1->log, $logM1, "Log.controller->log and Log.Model are equal after construction");
		//DO NOT MODIFY $logM1 BELOW THIS LINE: $logM1 will be static for comparision

		echo("<h3>Testing Log_Controller->actionInsert & Log_Controller->actionSearch</h3>");
		$logC1->actionInsert();
		$logC2 = new Log_Controller();
		$logC2->actionInsert();
		$logM2 = $logC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["id_user"], $logM2->id_user, "attr['id_typelog'] = to logM2->id_typelog");
		$this->assertEqual($attr["ref_type"], $logM2->ref_type, "attr['ref_type'] = to logM2->log");
		$this->assertEqual($attr["type_id"], $logM2->type_id, "attr['type_id'] = to logM2");
		//$this->assertEqual($attr["date"], $logM2->date, "attr['date'] = to logM2");
		$this->assertEqual($attr["alteration"], $logM2->alteration, "attr['alteration'] = to logM2");
		//check if works with objects
		$this->assertEqual($logM1->id_user, $logM2->id_user, "logM1->id_typelog = to logM2->id_typelog");
		$this->assertEqual($logM1->ref_type, $logM2->ref_type, "logM1->ref_type = to logM2->log");
		$this->assertEqual($logM1->type_id, $logM2->type_id, "logM1->type_id = to logM2");
		//$this->assertEqual($logM1->date, $logM2->date, "logM1->date = to logM2");
		$this->assertEqual($logM1->alteration, $logM2->alteration, "logM1->alteration = to logM2");
		
		echo("<h3>Testing Log_Controller->actionUpdate</h3>");
		$attr2 = array('id'=> 1, 'id_user'=> 90, 'ref_type'=> 89, 'type_id'=> 78,
				'date'=> $today2, 'alteration'=> 'Just one more test text!');
		$logC2->log->put($attr2);
		$logC2->actionUpdate();
		$logM3 = $logC2->log;
		$this->assertNotEqual($logM1->id_user, $logM3->id_user, '$logM1->id_user, $logM3->id_user');
		$this->assertNotEqual($logM1->ref_type, $logM3->ref_type, '$logM1->ref_type, $logM3->ref_type');
		$this->assertNotEqual($logM1->type_id, $logM3->type_id, "logM1 = to logM2");
		//$this->assertNotEqual($logM1->date, $logM3->date, "logM1 = to logM2");
		$this->assertNotEqual($logM1->alteration, $logM3->alteration, "logM1 = to logM2");
		$logC2 = NULL;
		$logM3 = NULL;
	
		echo("<h3>Testing Log_Controller->actionList</h3>");	
		$logC3 = new Log_Controller();
		//Do array magic
		$list = $logC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$logC3 = NULL;
		
		echo("<h3>Testing Log_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_log = 1", "like" => '', "limit" => '');
		$logM4 = $logC1->actionSearch($query);
		$this->assertIsA($logM4, 'Log_Model');		
		
		echo("<h3>Testing Log_Controller->actionDelete</h3>");
		$logM4 = $logC1->actionDelete('1');
		$logM5 = $logC1->actionSearch($query);
		$this->assertNull($logM5);
		echo("<h3>blah</h3>");
		
	}

}

?>