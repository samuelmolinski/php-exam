<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'simpleTest/autorun.php';
require_once '../controller/user_controller.php';
require_once '../model/user_model.php';

/**
 * Description of test_user
 *
 * @author Blue
 */
class Test_User_Controller extends UnitTestCase {
    
    public function test_User_Controller() {  
	$userC1 = new User_Controller;
        $this->assertNotNull($userC1);
        $userC1 = null;
        $this->assertNull($userC1);
        
        $attr = array("username" => "YourMomma", "email" => "YourMomma@hotmail.com", "password" => "spencer", "typeuser" => "admin", "active" => "true");		
        $userC1 = new User_Controller($attr);
        $userM1 = new User_Model($attr);
        $this->assertEqual($userC1->user, $userM1);
       
        /*$userC1->actionInsert();
        		
                        $user2 = new User_Model($attr);
                        inspect($user2);*/
        
    }
        
}

?>
