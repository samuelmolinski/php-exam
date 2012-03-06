<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpletest/autorun.php';
require_once ABSPATH . 'controller/typeuser.controller.php';
require_once ABSPATH . 'model/typeuser.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_typeuser
 *
 * @author Blue
 */
class Test_Typeuser_Controller extends UnitTestCase {

	public function test_Typeuser_Controller_Integrity() {
		
		echo("<h3>Testing Typeuser_Controller object creation/desturction</h3>");
		$typeuserC1 = new Typeuser_Controller();
		$this->assertNotNull($typeuserC1, "Creating typeuser.controller");
		$typeuserC1 = null;
		$this->assertNull($typeuserC1, "Destroying typeuser.controller");

		$attr = array('id'=> 1, 'name'=> 'admin', 'description'=> 'demi-god of the system');
		$typeuserC1 = new Typeuser_Controller($attr);
		//DO NOT MODIFY $typeuserC1 BELOW THIS LINE: $typeuserC1 will be static for comparision 
		
		$typeuserM1 = new Typeuser_Model($attr);
		$this->assertEqual($typeuserC1->typeuser, $typeuserM1, "Typeuser.controller->typeuser and Typeuser.Model are equal after construction");
		//DO NOT MODIFY $typeuserM1 BELOW THIS LINE: $typeuserM1 will be static for comparision

		echo("<h3>Testing Typeuser_Controller->actionInsert & Typeuser_Controller->actionSearch</h3>");
		$typeuserC1->actionInsert();
		$typeuserC2 = new Typeuser_Controller();
		$typeuserC2->actionInsert();
		$typeuserM2 = $typeuserC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["name"], $typeuserM2->name, "attr['name'] = to typeuserM2->name");
		$this->assertEqual($attr["description"], $typeuserM2->description, "attr['description'] = to typeuserM2->description");
		//check if works with objects
		$this->assertEqual($typeuserM1->name, $typeuserM2->name, "typeuserM1->name = to typeuserM2->name");
		$this->assertEqual($typeuserM1->description, $typeuserM2->description, "typeuserM1->description = to typeuserM2->description");
		
		echo("<h3>Testing Typeuser_Controller->actionUpdate</h3>");
		$attr2 = array('id'=> 1, 'name'=> 'user', 'description'=> 'casual user');
		$typeuserC2->typeuser->put($attr2);
		$typeuserC2->actionUpdate();
		$typeuserM3 = $typeuserC2->typeuser;
		$this->assertNotEqual($typeuserM1->name, $typeuserM3->name, '$typeuserM1->name, $typeuserM3->name');
		$this->assertNotEqual($typeuserM1->description, $typeuserM3->description, '$typeuserM1->description, $typeuserM3->description');
		$typeuserC2 = NULL;
		$typeuserM3 = NULL;
	
		echo("<h3>Testing Typeuser_Controller->actionList</h3>");	
		$typeuserC3 = new Typeuser_Controller();
		//Do array magic
		$list = $typeuserC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$typeuserC3 = NULL;
		
		echo("<h3>Testing Typeuser_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_typeuser = 1", "like" => '', "limit" => '');
		$typeuserM4 = $typeuserC1->actionSearch($query);
		$this->assertIsA($typeuserM4, 'Typeuser_Model');		
		
		echo("<h3>Testing Typeuser_Controller->actionDelete</h3>");
		$typeuserM4 = $typeuserC1->actionDelete('1');
		$typeuserM5 = $typeuserC1->actionSearch($query);
		//inspect($typeuserM5);
		$this->assertNull($typeuserM5);
		
	}

}

?>