<?php

class Question_Model{
        
		private $id;
        private $id_typequestion;
        private $versionphp;
		private $question;
		private $depreciated;
		private $difficulty;
		private $flagged;
		private $bln_eval;
		private $eval;
		private $id_topic;
		private $explanation;
		private $id_author;
		
		private	$attr = array();
		
		function __construct($param = NULL) {
			
			if (is_array($param)) {
				foreach ($param as $item) {
					$key = key($param);
					if (isset($param[$key])) {
			            $this->attr[$key] = $item;
			        }
		 			next($param);
				}
			}
		}
				
		public function __destruct() {
			//requires PHP version 5.3.6 or higher
			foreach ($this as $key => $value) { 
	        	unset($this->$key); 
	        }
		}
		public function __set($name, $value){
	        //echo "Setting '$name' to '$value'\n";
	        $this->attr[$name] = $value;
	    }
	
	    public function __get($name){
	       	//echo "Getting '$name'\n";
	        if (array_key_exists($name, $this->attr)) {
	            return $this->attr[$name];
	        }
	
	        $trace = debug_backtrace();
	        trigger_error(
	            'Undefined property via __get(): ' . $name .
	            ' in ' . $trace[0]['file'] .
	            ' on line ' . $trace[0]['line'],
	            E_USER_NOTICE);
	        return null;
	    }
	
	    public function __isset($name){
	        //echo "Is '$name' set?\n";
	        return isset($this->attr[$name]);
	    }
	
	    public function __unset($name){
	        //echo "Unsetting '$name'\n";
	        unset($this->$attr[$name]);
	    }
            
}

?>