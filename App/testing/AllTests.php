<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('config.php');
require_once('simpletest/autorun.php');
/**
 * Description of all_test
 *
 * @author Samuel Molinski <sjmolinski@gmail.com>
 */
class AllTests extends TestSuite {
    //put your code here
    public function AllTests() {
        $this->TestSuite('All tests');
    }
}

?>
