/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
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