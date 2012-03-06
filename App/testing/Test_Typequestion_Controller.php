<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpleTest/autorun.php';
require_once ABSPATH . 'controller/typequestion.controller.php';
require_once ABSPATH . 'model/typequestion.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_typequestion
 *
 * @author Blue
 */
class Test_Typequestion_Controller extends UnitTestCase {

	public function test_Typequestion_Controller_Integrity() {
		
			
		$today = (float)date("YmdHis"); 
		$today2 = (float)date("YmdHis") + 1; 
		
		echo("<h3>Testing Typequestion_Controller object creation/desturction</h3>");
		$typequestionC1 = new Typequestion_Controller();
		$this->assertNotNull($typequestionC1, "Creating typequestion.controller");
		$typequestionC1 = null;
		$this->assertNull($typequestionC1, "Destroying typequestion.controller");

		$attr = array('id'=> 1, 'name'=> 'super blah', 'description'=> 'mojo big bad');
		$typequestionC1 = new Typequestion_Controller($attr);
		//DO NOT MODIFY $typequestionC1 BELOW THIS LINE: $typequestionC1 will be static for comparision 
		
		$typequestionM1 = new Typequestion_Model($attr);
		$this->assertEqual($typequestionC1->typequestion, $typequestionM1, "Typequestion.controller->typequestion and Typequestion.Model are equal after construction");
		//DO NOT MODIFY $typequestionM1 BELOW THIS LINE: $typequestionM1 will be static for comparision

		echo("<h3>Testing Typequestion_Controller->actionInsert & Typequestion_Controller->actionSearch</h3>");
		$typequestionC1->actionInsert();
		$typequestionC2 = new Typequestion_Controller();
		$typequestionC2->actionInsert();
		$typequestionM2 = $typequestionC2->actionSearch(array('like' => 1));
		inspect($typequestionC1);
		inspect($typequestionM2);
		//check if information was displaced from orginal position
		$this->assertEqual($attr["name"], $typequestionM2->name, "attr['name'] = to typequestionM2->name");
		$this->assertEqual($attr["description"], $typequestionM2->description, "attr['description'] = to typequestionM2->description");
		//check if works with objects
		$this->assertEqual($typequestionM1->name, $typequestionM2->name, "typequestionM1->id_typetypequestion = to typequestionM2->id_typetypequestion");
		$this->assertEqual($typequestionM1->description, $typequestionM2->description, "typequestionM1->description = to typequestionM2->typequestion");
//		
//		echo("<h3>Testing Typequestion_Controller->actionUpdate</h3>");
//		$attr2 = array('id'=> 1, 'name'=> 90, 'description'=> 89);
//		$typequestionC2->typequestion->put($attr2);
//		$typequestionC2->actionUpdate();
//		$typequestionM3 = $typequestionC2->typequestion;
//		$this->assertNotEqual($typequestionM1->name, $typequestionM3->name, '$typequestionM1->name, $typequestionM3->name');
//		$this->assertNotEqual($typequestionM1->description, $typequestionM3->description, '$typequestionM1->description, $typequestionM3->description');
//		$typequestionC2 = NULL;
//		$typequestionM3 = NULL;
//	
//		echo("<h3>Testing Typequestion_Controller->actionList</h3>");	
//		$typequestionC3 = new Typequestion_Controller();
//		//Do array magic
//		$list = $typequestionC3->actionList();
//		$listUnique = array_unique($list);
//		$problems = array_diff($list, $listUnique);
//		$this->assertEqual(count($problems), '0', 'Should be 0');
//		$typequestionC3 = NULL;
//		
//		echo("<h3>Testing Typequestion_Controller->actionSearch array merge</h3>");
//		$query = array('where' => "int_id_typequestion = 1", "like" => '', "limit" => '');
//		$typequestionM4 = $typequestionC1->actionSearch($query);
//		$this->assertIsA($typequestionM4, 'Typequestion_Model');		
//		
//		echo("<h3>Testing Typequestion_Controller->actionDelete</h3>");
//		$typequestionM4 = $typequestionC1->actionDelete('1');
//		$typequestionM5 = $typequestionC1->actionSearch($query);
//		//inspect($typequestionM5);
//		$this->assertNull($typequestionM5);
		
	}

}

?>