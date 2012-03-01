<?php
	require_once (ABSPATH . '/Utility.php');

	class User_Model {

		private $id;
		private $username;
		private $email;
		private $password;
		private $typeuser;
		private $active;
		private $attr = array('id'=>NULL, 'username'=>NULL, 'email'=>NULL, 'password'=>NULL, 'typeuser'=>NULL, 'active'=>NULL);

		function __construct($param = NULL) {			
			$this->put($param);
		}

	//    public function __destruct() {
	//        //requires PHP version 5.3.6 or higher
	//        foreach ($this as $key => $value) {
	//            unset($this->$key);
	//        }
	//    }

		public function __set($name, $value) {
			//echo "Setting '$name' to '$value'\n";
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
			return $value;
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
		
		public function __toString() {
			return json_encode(get_object_vars($this));
		}

	}
?>