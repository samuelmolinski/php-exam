<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of log
 *
 * @author Samuel
 */
class Log_Model {
	
	private $id; //(int)
	private $id_user; //(int)
	private $ref_type; //(int) - example: 0 Misc, 1 Question, 2 Answer, etc
	private $type_id; //(int) - this refers to the id of the question or answer
	private $date; //(int)
	private $alteration; //(string)

	private $attr = array('id'=>NULL, 'id_user'=>NULL, 'ref_type'=>NULL, 'type_id'=>NULL, 'date'=>NULL, 'alteration'=>NULL);

	function __construct($param = NULL) {			
		$this->put($param);
	}

	public function __destruct() {
		//requires PHP version 5.3.6 or higher
		foreach ($this as $key => $value) {
			unset($this->$key);
		}
	}

	public function __set($name, $value) {						
		$this->attr[$name] = $this->validate($name, $value);		
	}

	public function __get($name) {
		//echo "Getting '$name'\n";
		if (array_key_exists($name, $this->attr)) {
			return $this->attr[$name];
		}

		$trace = debug_backtrace();
		trigger_error(
				'Undefined property via __get(): ' . $name .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'], E_USER_NOTICE);
		return null;
	}

	public function __isset($name) {
		//echo "Is '$name' set?\n";
		return isset($this->attr[$name]);
	}

	public function __unset($name) {
		//echo "Unsetting '$name'\n";
		unset($this->$attr[$name]);
	}
	
	private function validate($name, $value) {
		//add validation based on $name
		switch ($name) {
			case 'alteration' :
				return (string) $value;
				break;
			case 'date':
				return (float) $value;
			default:					
				return (int)$value;

		}
		
	}
	public function put($param = NULL) {
		//set a group of property based on an array input
		$semID = FALSE;
		//QUICK SKIP if ID is ommited
		if (count($param) == count($this->attr)-1) {
			$semID = TRUE;
		}

		if (is_array($param)) {
			//if the array passes by objest by association or index
			if (Utility::isAssoc($param)){ 
				foreach ($param as $key => $item) {
					//Preserve data integrity and filter out non-attributes
					if (key_exists($key, $this->attr)) {
						$this->attr[$key] = $this->validate($key, $item);
					}
				}				
			} else {

				foreach ($this->attr as $key => $val) {
					if (($key == 'id')&&($semID)) {continue;}//skipping id update
					$this->attr[$key] = $this->validate($key, array_shift($param));
				}

			}
		}
	}
	/* This is used this to quicky compare if two arrays of User.Models are
	 * by using array_diff() to compare them as strings. Ideally json encode
	 * should produce unique strings with the obj variables
	 */
	public function __toString() {
		return json_encode(get_object_vars($this));
	}
}

?>
