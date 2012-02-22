/**
 * @author Samuel
 */

function update(type){
	$.ajax({
		type: 'GET',
		url: 'ajax.php',
		dataType: 'json',
		data: {
			//General
			requestType : type,
			userID : $("#userID").val(),
			//New Question
			qType : $("#qType").val(),
			qTopic : $("#qTopic").val(),
			qNewTopic : $("#qNewTopic").val(),
			//Statement
			qText : $("#qText").val(),
			qCanEvaluate : $("#qCanEvaluate").val(),
			qEvalCode : $("#qEvalCode").val(),
			qStatementReady : $("#qStatementReady").val(),
			//Correct Answers
			qAnswerTextC : $("#qAnswerTextC").val(),
			qAnswersC : $("#qAnswersC").val(),
			qAddAnswerC : $("#qAddAnswerC").val(),
			qEditAnswerC : $("#qEditAnswerC").val(),
			qAnswersCReady : $("#qAnswersCReady").val(),
			//Incorrect Answers
			qAnswerTextI : $("#qAnswerTextI").val(),
			qAnswersI : $("#qAnswersI").val(),
			qAddAnswerI : $("#qAddAnswerI").val(),
			qEditAnswerI : $("#qEditAnswerI").val(),
			qAnswersIReady : $("#requestType").val()
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			//handle error
		},
		success: function(data){
			//hand success
		}
	});
};