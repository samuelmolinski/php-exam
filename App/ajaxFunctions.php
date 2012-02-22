<?php
    /*
	 * Functions called during AJAX calls
	 * 
	 */
	
	function dataSanitation($data) {
		if (is_string($data)) {
			$data = mysql_real_escape_string($data);
		} elseif (is_array($data)) {
			foreach ($data as $entry) {
				$entry = dataSanitation($entry);
			}
		}
		return $data;
	}
	
	function close($return, $error, $msg) {		
		$return['error'] = $error;
		$return['msg'] = $msg;
				
		// finally print the output.	
		echo json_encode($return);
	}
	
	function addTopic($data, $return) {
		
		close($return, TRUE, "addTopic was successful");
	}
	function readyQuestion($data, $return) {
		
		close($return, FALSE, "readyQuestion was successful");
	}
	function addAnswerCorrect($data, $return) {
		
		close($return, FALSE, "addAnswerCorrect was successful");
	}
	function editAnswerCorrect($data, $return) {
		
		close($return, FALSE, "editAnswerCorrect was successful");
	}
	function readyAnswerCorrect($data, $return) {
		
		close($return, FALSE, "readyAnswerCorrect was successful");
	}
	function addAnswerIncorrect($data, $return) {
		
		close($return, FALSE, "addAnswerIncorrect was successful");
	}
	function editAnswerIncorrect($data, $return) {
		
		close($return, FALSE, "editAnswerIncorrect was successful");
	}
	function readyAnswerIncorrect($data, $return) {
		
		close($return, FALSE, "readyAnswerIncorrect was successful");
	}
	function updateSimilarQuestion($data, $return) {
		
		close($return, FALSE, "updateSimilarQuestion was successful");
	}
	function updatePreviousQuestion($data, $return) {
		
		close($return, FALSE, "updatePreviousQuestion was successful");
	}
	function debug($data, $return) {
		foreach ($data as $item) {
					$key = key($data);
					if (($item != NULL)&&($key != NULL)) {
						$return[$key] = $item;
					}
		 			next($data);
				}
		return $return;
	}
?>