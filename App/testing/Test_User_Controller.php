<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpleTest/autorun.php';
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
		$userC1 = new User_Controller();
		$this->assertNotNull($userC1, "Creating user.controller");
		$userC1 = null;
		$this->assertNull($userC1, "Destroying user.controller");

		$attr = array("username" => "YourMomma", "email" => "YourMomma@hotmail.com", "password" => "spencer", "typeuser" => "1", "active" => "1");
		$userC1 = new User_Controller($attr);
		$userM1 = new User_Model($attr);
		$this->assertEqual($userC1->user, $userM1, "User.controller->user and User.Model are equal after construction");

		$userC1->actionInsert();
		$userC2 = new User_Controller();
		$userM2 = $userC2->actionSearch(array('like' => 1));
		inspect($userM1);        
		inspect($userM2);        
		$this->assertEqual($userM1->email, $userM2->email, "Creating user.controller");
	}

}

?>