<?php
/**
 * Description of EnlightenEngine
 *
 * @author Samuel
 */
require_once(ABSPATH . 'config.php');
require_once(ABSPATH . 'Utility.php');
require_once(ABSPATH . 'inspect.php');
require_once(ABSPATH . 'controller/answer.controller.php');
require_once(ABSPATH . 'controller/log.controller.php');
require_once(ABSPATH . 'controller/question.controller.php');
require_once(ABSPATH . 'controller/topic.controller.php');
require_once(ABSPATH . 'controller/typequestion.controller.php');
require_once(ABSPATH . 'controller/typeuser.controller.php');
require_once(ABSPATH . 'controller/user.controller.php');


class EnlightenEngine {
		
	public function render($view) {
		/* $view is the prefix to the view file. 
		 * IE: fore questionBuilder.view.php, $view = questionBuilder
		 */
		include (ABSPATH . 'view/'.$view.'.view.php');
	}
	
	public function addQuestion($data = array()) {
		if ((!is_array($data))|| (count($data)<1)) {
			trigger_error(
				' array empty or  wrong data type' . $data .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'], E_USER_NOTICE);
			return null;
		}
		
		$code = '';
		$ver = phpversion();
		$flag = 0;
		$user = $this->getCurrentUser();
		
		if ($data['qCanEvaluate'] == True) {
			$code = $data['qEvalCode'];
		}
		if (($data['qVersion'] == NULL) || ($data['qVersion'] == '')) {
			$ver = phpversion();
		} else {
			$ver = $data['qVersion'];
			$flag = 100;
		}
		
		$attrQ = array('id_typequestion'=>$data['qType'], 
					'question'=>$data['qText'], 'versionphp'=>$ver, 'depreciated'=>FALSE, 
					'difficulty'=> 1, 'flagged'=> $flag, 'bln_eval'=> $data['qCanEvaluate'], 
					'eval'=> $code, 'id_topic'=> $data['qTopic'], 'explaination'=>NULL, 
					'id_author'=> $user);
		
		$newQ = new Question_Controller($attr);
		$newQ->actionInsert();
		
		$this->createLog($user, 0, $newQ->id, "Addition of question #$newQ->id");
		
		return $newQ->id;
	}
	
	public function previousQuestions() {
		$newQ = new Question_Controller($attr);
		$search = array('asc' => "int_id_typequestion", 'where' => "int_id_question", 'like' => "*", 'limit' => "20");
		$newQ->actionSearch($search);
		
		return $newQ->id;
	}
		
	public function getCurrentUser(){
		return 1;
	}
	
	public function createLog($user, $ref, $id, $msg) {
		//creating a log of the action
		$newLog = new Log_Controller(array('id_user'=>$user, 'ref_type'=> $ref, 'type_id'=>$id, 'data'=> cDate(), 
					'alteration'=> $msg));
		$newLog->actionInsert();
	}
	
	public function cDate() {
		return (string)date("YmdHis");
	}
}

?>