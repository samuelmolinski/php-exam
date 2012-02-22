<?php
    //phpinfo();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>PHP Exam</title>
		<meta name="description" content="" />
		<meta name="author" content="Cabana Criacão" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<link type="text/css" href="css/overcast/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
		<!-- CSS -->
		<style type="text/css" media="screen">
			body {background-color:#5295C5; min-width: 960px; overflow-x: hidden;}
			#main {width: 960px; margin: -10px auto 0;}
			#similarQuestions {position:absolute; min-width: 270px; padding:30px;left:0; top:0; border-bottom-right-radius: 36px;}
			#previousQuestions {position:absolute; min-width: 270px; padding:30px;right:0; top:0; border-bottom-left-radius: 36px;}
			#similarQuestions .tab { float: right; margin-right: -25px;}
			#previousQuestions .tab { float: left; margin-left: -25px;}
			.tab {background-image: url("css/overcast/images/ui-icons_70b2e1_256x240.png"); margin-top: -25px;border: 3px solid #74B2E4; width: 16px; height:16px; border-radius: 15px;height: 17px; width: 17px;}
			.tab:hover {background-image: url("css/overcast/images/ui-icons_3383bb_256x240.png");border-color: #3482bc;}
			.mainContainer {border:solid 1px #ccc; box-shadow: 0 0 15px 1px rgba(0,0,0,.5); padding: 30px 50px; background-color: #eee;}
			.sidePanel {min-height: 400px;}
			#evalPanel {clear:both; float: left; display: none;}
			footer {width: 900px; padding:20px 0; text-align: center; float: left;}
			.clear {clear: both;}
			.left {float: left;}
			.right {float: right;}
			.hidden {display: none;}
			.subPanel {width: 400px;}
			.mainPanel {margin:0 auto; width:900px;}
			.ready {float: right; margin-right: 10px;}
			hr {border: none; border-top: dashed medium #666; width: 100%;clear: both; float: left;}
			label span {display: block;}
			textarea, fieldset {float: left; clear: left;border-radius: 10px; border: 1px solid #999999;}
			fieldset.mainPanel {margin: 15px auto; padding: 20px;}
			textarea {padding: 1em;}
			
			
			
		</style>
		<!-- JS -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
		<script src="js/ajax.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="similarQuestions" class="mainContainer sidePanel">
			<div class="tab ui-icon-plusthick"></div>
			<h1>Similar Questions</h1>
		</div>
		<div id="previousQuestions" class="mainContainer sidePanel">
			<div class="tab ui-icon-plusthick"></div>
			<h1>Previous Questions</h1>
		</div>
		<div>
			<div id="main" class="mainContainer">
			
			<header>
				<h1>PHP Exam</h1>
			</header>
			<!-- <nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav> -->
				<form action="index_submit" method="get" accept-charset="utf-8" class="left">
					<fieldset id="qStatement" class="mainPanel">
						<legend>Question</legend>
						<div class="left clear mainPanel">
							<label for="qType" class="clear">
								<select id="qType" name="qType">
									<option value="0">MCQ - Multiple Choice Question</option>
									<option value="1">MCQP - Multiple Choice Question Plus</option>
									<option value="2">SAQ - Short Answer Question</option>
									<option value="3">FD - Function Definition</option>						
								</select>
							</label>
							<label for="qTopic" class="clear">
								<select id="qTopic" name="qTopic">
									<option value="0">Basic</option>
									<option value="1">Logic</option>
									<option value="2">Variables</option>
									<option value="3">Structures</option>
									<option value="3">Function</option>
								</select>
							</label>
							<label for="qNewTopic" class="clear"><input type="button" name="qNewTopic" id="qNewTopic" value="Add Topic"/></label>
						</div>
						<label for="qText" class="left clear"><span>Statement</span><textarea name="qText" rows="15" cols="108"></textarea></label>
						<label for="qCanEvaluate" class="clear"><input type="checkbox" name="qCanEvaluate" id="qCanEvaluate"/>Enable this question for active code evaluation.</label>
						
						<div id="evalPanel" class="">
							<hr/>
							<label for="qEvalCode" class="clear"><span>Example Code</span><textarea name="qEvalCode" rows="15" cols="108"></textarea></label>
							<hr/>
						</div>
						<label for="qStatementReadyButton" class="clear ready"><input type="button" name="qStatementReadyButton" id="qStatementReadyButton" value="Ready"/></label>
					</fieldset>
					<fieldset id="qAnswersC" class="mainPanel">
						<legend>Add Answers (Correct)</legend>
						<label for="qAnswerTextC" class="clear"><span>Answer</span><textarea name="qAnswerTextC" rows="4" cols="108"></textarea></label>
						<label for="qAnswersC" class="clear"><span>Previous Answers</span><textarea name="qAnswersC" rows="5" cols="30" disabled="true"></textarea></label>
						<div class="subPanel right">
							<label for="qAddAnswerC" class="clear"><input type="button" name="qAddAnswerC" id="qAddAnswerC" value="Add"/>Add</label>
							<label for="qEditAnswerC" class="clear"><input type="button" name="qEditAnswerC" id="qEditAnswerC" value="Edit"/>Edit</label>
						</div>
						<label for="qAnswersCReadyButton" class="clear"><input type="button" name="qAnswersCReadyButton" id="qAnswersCReadyButton" value="Ready"/></label>
					</fieldset>
					<fieldset id="qAnswersI" class="mainPanel">
						<legend>Add Answers Bank (Incorrect)</legend>
						<label for="qAnswerTextI" class="clear"><span>Answer</span><textarea name="qAnswerTextI" rows="4" cols="108"></textarea></label>
						<label for="qAnswersI" class="clear"><span>Previous Answers</span><textarea name="qAnswersI" rows="5" cols="30"  disabled="true"></textarea></label>
						<div class="subPanel right">
							<label for="qAddAnswerI" class="clear"><input type="button" name="qAddAnswerI" id="qAddAnswerI" value="Add"/>Add</label>
							<label for="qEditAnswerI" class="clear"><input type="button" name="qEditAnswerI" id="qEditAnswerI" value="Edit"/>Edit</label>
						</div>
						<label for="qAnswersIReadyButton" class="clear"><input type="button" name="qAnswersIReadyButton" id="qAnswersIReadyButton" value="Ready"/></label>
					</fieldset>
					<!-- <fieldset id="qAnswersA" class="mainPanel">
						<legend>Advance Answers Bank Generation (experimental)</legend>
						<label for="qAnswerTextA" class="clear"><span>Answer</span><textarea name="qAnswerTextA" rows="4" cols="60"></textarea></label>
						<label for="qAnswersA" class="clear"><span>Previous Answers</span><textarea name="qAnswersA" rows="5" cols="20"></textarea></label>
						<label for="qAddAnswerA" class="clear"><input type="button" name="qAddAnswerA" id="qAddAnswerA" value="Add"/>Add</label>
						<label for="qEditAnswerA" class="clear"><input type="button" name="qEditAnswerA" id="qEditAnswerA" value="Edit"/>Edit</label>
					</fieldset> -->	
					<div class="clear"></div>
					<input id="requestType" type="hidden" value="debug"/>
					<input id="userID" type="hidden" value="1"/>
					<input id="qStatementReady" type="hidden" value=""/>
					<input id="qAnswersCReady" type="hidden" value=""/>
					<input id="qAnswersIReady" type="hidden" value=""/>
				</form>
			<footer>
				<p>
					&copy; Copyright  by Samuel Molinski and Eduardo Chaves
				</p>
			</footer>
			<div class="clear"></div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				init();
				window.setTimeout('panelSlide()',1000);
			});	
			
			function init() {
				//slider and default position
				$("#qCanEvaluate").click(function(){$('#evalPanel').slideToggle();});
				if ($("#qCanEvaluate:checked").prop("checked")) {$('#evalPanel').slideDown();}
				
				//side tabs
				$( "#similarQuestions" ).resizable({ minWidth: 270,  handles: 'se' });
				$( "#previousQuestions" ).resizable({ minWidth: 270,  handles: 'sw' });
				
				//Ajax calls 
				$("#qStatementReadyButton").click(function(){update('qStatementReady');});
				$("#qAnswersCReadyButton").click(function(){update('qAnswersCReady');});
				$("#qAnswersIReadyButton").click(function(){update('qAnswersIReady');});
				$("#qAddAnswerC").click(function(){update('qAddAnswerC');});
				$("#qAddAnswerI").click(function(){update('qAddAnswerI');});
				$("#qEditAnswerC").click(function(){update('qEditAnswerC');});
				$("#qEditAnswerI").click(function(){update('qEditAnswerI');});
				/*				
					$("#").click(function(){
						$("#requestType").val('')
						update();
					});
				*/
				
				
				$("#similarQuestions .tab").click(function(){
					var width = $("#similarQuestions").width();
					var cur = $("#similarQuestions").css("left").slice(0,-2);
					
					if ($(this).hasClass('ui-icon-minusthick'))  {
						var mod = parseInt(cur)+width+30;
						console.debug("minus" + width + ', ' + cur + ', '+ mod);
					} else {
						var mod = parseInt(cur)-width-30;
						console.debug("plus" + width + ', ' + cur + ', '+ mod);
					}
					
					$("#similarQuestions").animate({left: mod}, 500);
					$(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
				});
				
				$("#previousQuestions .tab").click(function(){
					var width = $("#previousQuestions").width();
					var cur = $("#previousQuestions").css("left").slice(0,-2);
					
					if ($(this).hasClass('ui-icon-minusthick'))  {
						var mod = parseInt(cur)-width-30;
						console.debug("minus" + width + ', ' + cur + ', '+ mod);
					} else {
						var mod = parseInt(cur)+width+30;
						console.debug("plus" + width + ', ' + cur + ', '+ mod);
					}
					
					$("#previousQuestions").animate({left: mod}, 500);
					$(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
				});
			}
			function panelSlide() {
				$("#previousQuestions .tab").trigger('click');
				$("#similarQuestions .tab").trigger('click');
			}
		</script>
	</body>
</html>