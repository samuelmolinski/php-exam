<?php

class Question_Model{
        
	private $id; //(int)
	private $id_typequestion; //(int)
	private $versionphp; //(string)
	private $question; //(string)
	private $depreciated; //(boolen)
	private $difficulty; //(float)
	private $flagged; //(int)
	private $bln_eval; //(boolen)
	private $eval; //(string)
	private $id_topic; //(int)
	private $explaination; //(string)
	private $id_author; //(int)

	private $attr = array('id'=>NULL, 'id_typequestion'=>NULL, 
					'question'=>NULL, 'versionphp'=>NULL, 'depreciated'=>NULL, 
					'difficulty'=>NULL, 'flagged'=>NULL, 'bln_eval'=>NULL, 
					'eval'=>NULL, 'id_topic'=>NULL, 'explaination'=>NULL, 
					'id_author'=>NULL);

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
			case 'id' :
			case 'id_typequestion' :
			case 'flagged' :
			case 'id_topic' :
			case 'id_author' :
				return (int) $value;
				break;
			case 'bln_depreciated' :
			case 'bln_eval' :
				return (bool) $value;
				break;
			default:					
				return (string)$value;

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