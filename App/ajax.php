<?php
	
	require_once('ajaxFunctions.php');
	require_once('inspect.php');
	
	if(FALSE) {
		ini_set('display_errors','On');
		error_reporting(E_ALL);
	} else {
		error_reporting(E_ALL ^ E_NOTICE);
	}
	
	// Vars
	$methodTypePOST = FALSE;
	$data = array();
	$return = array();
	//$userUD = 1;
	
	if(!(empty($_POST['userID']) && empty($_GET['userID']))) {
	
		//quick debugging switch for using $_GET variable
		if ($methodTypePOST == TRUE) {
			//General
			$data['requestType'] = $_POST['requestType'];			
			//New Question
			$data['qType'] = $_POST['qType'];
			$data['qTopic'] = $_POST['qTopic'];
			$data['qNewTopic'] = $_POST['qNewTopic'];
			//Statement
			$data['qText'] = $_POST['qText'];
			$data['qCanEvaluate'] = $_POST['qCanEvaluate'];
			$data['qEvalCode'] = $_POST['qEvalCode'];
			$data['qStatementReady'] = $_POST['qStatementReady'];
			//Correct Answers
			$data['qAnswerTextC'] = $_POST['qAnswerTextC'];
			$data['qAnswersC'] = $_POST['qAnswersC'];
			$data['qAddAnswerC'] = $_POST['qAddAnswerC'];
			$data['qEditAnswerC'] = $_POST['qEditAnswerC'];
			$data['qAnswersCReady'] = $_POST['qAnswersCReady'];
			//Incorrect Answers
			$data['qAnswerTextI'] = $_POST['qAnswerTextI'];
			$data['qAnswersI'] = $_POST['qAnswersI'];
			$data['qAddAnswerI'] = $_POST['qAddAnswerI'];
			$data['qEditAnswerI'] = $_POST['qEditAnswerI'];
			$data['qAnswersIReady'] = $_POST['qAnswersIReady'];
		} else {
			//General
			$data['requestType'] = $_GET['requestType'];
			//New Question
			$data['qType'] = $_GET['qType'];
			$data['qTopic'] = $_GET['qTopic'];
			$data['qNewTopic'] = $_GET['qNewTopic'];
			//Statement
			$data['qText'] = $_GET['qText'];
			$data['qCanEvaluate'] = $_GET['qCanEvaluate'];
			$data['qEvalCode'] = $_GET['qEvalCode'];
			$data['qStatementReady'] = $_GET['qStatementReady'];
			//Correct Answers
			$data['qAnswerTextC'] = $_GET['qAnswerTextC'];
			$data['qAnswersC'] = $_GET['qAnswersC'];
			$data['qAddAnswerC'] = $_GET['qAddAnswerC'];
			$data['qEditAnswerC'] = $_GET['qEditAnswerC'];
			$data['qAnswersCReady'] = $_GET['qAnswersCReady'];
			//Incorrect Answers
			$data['qAnswerTextI'] = $_GET['qAnswerTextI'];
			$data['qAnswersI'] = $_GET['qAnswersI'];
			$data['qAddAnswerI'] = $_GET['qAddAnswerI'];
			$data['qEditAnswerI'] = $_GET['qEditAnswerI'];
			$data['qAnswersIReady'] = $_GET['qAnswersIReady'];
		}
		
		dataSanitation($data);
		
		switch ($data['requestType']) {
		    case 'addTopic':
				addTopic($data, $return);
		        break;
		    case 'qStatementReady':
				readyQuestion($data, $return);
		        break;
		    case 'qAddAnswerC':
				addAnswerCorrect($data, $return);
		        break;
		    case 'qEditAnswerC':
				editAnswerCorrect($data, $return);
		        break;
		    case 'qAnswersCReady':
				readyAnswerCorrect($data, $return);
		        break;
		    case 'qAddAnswerI':
				addAnswerIncorrect($data, $return);
		        break;
		    case 'qEditAnswerI':
				editAnswerIncorrect($data, $return);
		        break;
		    case 'qAnswersIReady':
				readyAnswerIncorrect($data, $return);
		        break;
		    case 'updateSimilarQuestion':
				updateSimilarQuestion($data, $return);
		        break;
		    case 'updatePreviousQuestion':
				updatePreviousQuestion($data, $return);
		        break;
			default:
				debug($data, $return);
				close($return, TRUE, "General Failure");
				break;
		}		
		
	} else {
		close($return, TRUE, "No userID");
	}
?>