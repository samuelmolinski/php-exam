<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpletest/autorun.php';
require_once ABSPATH . 'controller/user.controller.php';
require_once ABSPATH . 'model/user.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_User_Controller extends UnitTestCase {

	public function test_User_Controller_Integrity() {
		
		echo("<h3>Testing User_Controller object creation/desturction</h3>");
		$userC1 = new User_Controller();
		$this->assertNotNull($userC1, "Creating user.controller");
		$userC1 = null;
		$this->assertNull($userC1, "Destroying user.controller");

		$attr = array("username" => "YourMomma", "email" => "YourMomma@hotmail.com", "password" => "spencer", "typeuser" => "2", "active" => "1");
		$userC1 = new User_Controller($attr);
		//DO NOT MODIFY $userC1 BELOW THIS LINE: $userC1 will be static for comparision 
		
		$userM1 = new User_Model($attr);
		$this->assertEqual($userC1->user, $userM1, "User.controller->user and User.Model are equal after construction");
		//DO NOT MODIFY $userM1 BELOW THIS LINE: $userM1 will be static for comparision

		echo("<h3>Testing User_Controller->actionInsert & User_Controller->actionSearch</h3>");
		$userC1->actionInsert();
		$userC2 = new User_Controller();
		$userC2->actionInsert();
		$userM2 = $userC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["username"], $userM2->username, "userM1 = to userM2");
		$this->assertEqual($attr["password"], $userM2->password, "userM1 = to userM2");
		$this->assertEqual($attr["typeuser"], $userM2->typeuser, "userM1 = to userM2");
		$this->assertEqual($attr["active"], $userM2->active, "userM1 = to userM2");
		//check if works with objects
		$this->assertEqual($userM1->username, $userM2->username, "userM1 = to userM2");
		$this->assertEqual($userM1->password, $userM2->password, "userM1 = to userM2");
		$this->assertEqual($userM1->typeuser, $userM2->typeuser, "userM1 = to userM2");
		$this->assertEqual($userM1->active, $userM2->active, "userM1 = to userM2");
		
		echo("<h3>Testing User_Controller->actionUpdate</h3>");
		$attr2 = array("username" => "DaddyWasHere", "email" => "DaddyWasHere@hotmail.com", "password" => "DaddyWasHere", "typeuser" => "3", "active" => "0");
		$userC2->user->put($attr2);
		$userC2->actionUpdate();
		$userM3 = $userC2->user;
		$this->assertNotEqual($userM1->username, $userM3->username, "userM1 != to userM3");
		$this->assertNotEqual($userM1->email, $userM3->email, "userM1 != to userM3");
		$this->assertNotEqual($userM1->password, $userM3->password, "userM1 != to userM3");
		$this->assertNotEqual($userM1->typeuser, $userM3->typeuser, "userM1 != to userM3");
		$this->assertNotEqual($userM1->active, $userM3->active, "userM1 != to userM3");
		$userC2 = NULL;
		$userM3 = NULL;
		
		if (PDO_DEBUG) {
		echo("<h3>Testing User_Controller ID uniqueness: expecting error SQLSTATE[23000]</h3>");
		$userC3 = new User_Controller($attr);
		$userC3->actionInsert();
		$this->assertEqual($userC3->getError(), '23000', 'Should get a error 23000 from SQL that the email address is already used');
		$userC3 = NULL;
		} else {
			echo("<p style='background:#D3C503;'>User_Controller ID uniqueness test is suppressed; enable by setting PDO_DEBUG = TRUE</p>");
		}
				
		echo("<h3>Testing User_Controller->actionList</h3>");	
		$userC3 = new User_Controller();
		//Do array magic
		$list = $userC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$userC3 = NULL;
		
		echo("<h3>Testing User_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_user = 1", "like" => '', "limit" => '');
		$userM4 = $userC1->actionSearch($query);
		$this->assertIsA($userM4, 'User_Model');		
		
		echo("<h3>Testing User_Controller->actionDelete</h3>");
		$userM4 = $userC1->actionDelete('1');
		$userM5 = $userC1->actionSearch($query);
		//inspect($userM5);
		$this->assertNull($userM5);
		
	}

}

?>