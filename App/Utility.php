<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utility
 *
 * @author Samuel Molinski <sjmolinski@gmail.com>
 */
class Utility {

	//put your code here
	function isAssoc($arr) {
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

}

?>
