<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ABSPATH . 'testing/simpletest/autorun.php';
require_once ABSPATH . 'controller/topic.controller.php';
require_once ABSPATH . 'model/topic.model.php';
require_once ABSPATH . 'inspect.php';

/**
 * Description of test_topic
 *
 * @author Blue
 */
class Test_Topic_Controller extends UnitTestCase {

	public function test_Topic_Controller_Integrity() {
		
		echo("<h3>Testing Topic_Controller object creation/desturction</h3>");
		$topicC1 = new Topic_Controller();
		$this->assertNotNull($topicC1, "Creating topic.controller");
		$topicC1 = null;
		$this->assertNull($topicC1, "Destroying topic.controller");

		$attr = array('id'=> 1, 'name'=> 'functions', 'description'=> 'everything about functions');
		$topicC1 = new Topic_Controller($attr);
		//DO NOT MODIFY $topicC1 BELOW THIS LINE: $topicC1 will be static for comparision 
		
		$topicM1 = new Topic_Model($attr);
		$this->assertEqual($topicC1->topic, $topicM1, "Topic.controller->topic and Topic.Model are equal after construction");
		//DO NOT MODIFY $topicM1 BELOW THIS LINE: $topicM1 will be static for comparision

		echo("<h3>Testing Topic_Controller->actionInsert & Topic_Controller->actionSearch</h3>");
		$topicC1->actionInsert();
		$topicC2 = new Topic_Controller();
		$topicC2->actionInsert();
		$topicM2 = $topicC2->actionSearch(array('like' => 1));
		//check if information was displaced from orginal position
		$this->assertEqual($attr["name"], $topicM2->name, "attr['name'] = to topicM2->id_typetopic");
		$this->assertEqual($attr["description"], $topicM2->description, "attr['description'] = to topicM2->topic");
		//check if works with objects
		$this->assertEqual($topicM1->name, $topicM2->name, "topicM1->id_typetopic = to topicM2->id_typetopic");
		$this->assertEqual($topicM1->description, $topicM2->description, "topicM1->topic = to topicM2->topic");
		
		echo("<h3>Testing Topic_Controller->actionUpdate</h3>");
		$attr2 = array('id'=> 1, 'name'=> 'FUNCTIONS', 'description'=> 'FUNCTIONS and everything else');
		$topicC2->topic->put($attr2);
		$topicC2->actionUpdate();
		$topicM3 = $topicC2->topic;
		$this->assertNotEqual($topicM1->name, $topicM3->name, '$topicM1->id_typetopic, $topicM3->id_typetopic');
		$this->assertNotEqual($topicM1->description, $topicM3->description, '$topicM1->topic, $topicM3->topic');
		$topicC2 = NULL;
		$topicM3 = NULL;
	
		echo("<h3>Testing Topic_Controller->actionList</h3>");	
		$topicC3 = new Topic_Controller();
		//Do array magic
		$list = $topicC3->actionList();
		$listUnique = array_unique($list);
		$problems = array_diff($list, $listUnique);
		$this->assertEqual(count($problems), '0', 'Should be 0');
		$topicC3 = NULL;
		
		echo("<h3>Testing Topic_Controller->actionSearch array merge</h3>");
		$query = array('where' => "int_id_topic = 1", "like" => '', "limit" => '');
		$topicM4 = $topicC1->actionSearch($query);
		$this->assertIsA($topicM4, 'Topic_Model');		
		
		echo("<h3>Testing Topic_Controller->actionDelete</h3>");
		$topicM4 = $topicC1->actionDelete('1');
		$topicM5 = $topicC1->actionSearch($query);
		$this->assertNull($topicM5);
		
	}

}

?>