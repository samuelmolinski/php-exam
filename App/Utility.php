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
	
	public function formatArraySingle($list, $class) {
		//returning values as a single object or an array of those objects
		$return = array();
		//create array of objects and propogate with data
		foreach ($list as $item) {
			unset ($attr);
			//create index array of vales
			foreach ($item as $value) {
				$attr[] = $value;
			}
			//push array of values for the conctructor to handle
			$return[] = new $class($attr);
		}
		// if multiple objects return an array, otherwise just a single object
		if (count($return)>1) {			
			return $return;
		} else {
			return array_shift($return);
		}
	}

}

?>
