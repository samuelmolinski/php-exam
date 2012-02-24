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
class Test_User_Model extends UnitTestCase {
    
    public function test_User_Controller() {  
        $userM = new User_Model;
        $userM->username = 'Your Momma';
        assertEqual($userM->username, 'Your Momma');

        $userM = null;
        

        $attr = array("id" => 5678, "username" => "YourMomma", "email" => "YourMomma@hotmail.com");
        
        //$user2 = new User_Model($attr);
        //inspect($user2);
    }
        
}

?>
