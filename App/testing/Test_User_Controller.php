<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH .'testing/simpleTest/autorun.php';
require_once ABSPATH .'controller/user.controller.php';
require_once ABSPATH .'model/user.model.php';
require_once ABSPATH .'inspect.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_User_Controller extends UnitTestCase {
    
    public function test_User_Controller_Integrity() {  
	$userC1 = new User_Controller();        
        $this->assertNotNull($userC1);
        $userC1 = null;
        $this->assertNull($userC1);
        
        $attr = array("username" => "YourMomma", "email" => "YourMomma@hotmail.com", "password" => "spencer", "typeuser" => "admin", "active" => "true");		
        $userC1 = new User_Controller($attr);
        $userM1 = new User_Model($attr);
//        inspect($userC1);
//        inspect($userM1);
//        $this->assertEqual($userC1->user, $userM1);
       
        /*$userC1->actionInsert();
        $user2 = new User_Model($attr);
        inspect($user2);*/
        
    }
        
}

?>
