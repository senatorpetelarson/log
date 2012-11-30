/**
 * @projectDescription The main javascript file for the LogRhythm cyber-ready quiz
 * @author plarson@jiffymedia.com
 * @version 0.1
 */

var currentQuestionIndex, pages;
currentQuestionIndex = 0;

/**
 * Advances to the next question
 */
function advanceQuestion() {
	questions[currentQuesitonIndex].find(".nextPane").unbind('click');
	
}

function printResults() {
	//$(".E").html($(".E").html().replace('<span class="read-more-link">.. <a href="#">READ MORE</a>',''));
	$(".read-more-link").hide();
	$(".extended-results").slideDown(300,'easeInOutCubic',function() {
		window.print();
	});
}

$(document).ready(function() {
	pages = [$(".A"),$(".B"),$(".C"),$(".D"),$(".E")];
	$(".read-more-link").click(function(evt) {
		evt.preventDefault();
		$(this).hide();
		$(".extended-results").slideDown(300,'easeInOutCubic');
	});
	$(".form-h2").cycle({
		fx: 				'scrollHorz',
		speed:  			300,
		timeout:			0,
		easing:				'easeInOutCubic'
	});
	setTimeout(resetQuestionBG,1000);
	$(".nextPane").click(function() {
		if(validatePage(pages[currentQuestionIndex])) {
			currentQuestionIndex++;
			$(".form-h2").cycle('next');
		} else {
			alert("Please fill out all fields before moving on.");
		}
	});
	$(".prevPane").click(function() {
		currentQuestionIndex--;
		$(".form-h2").cycle('prev');
	});
	$(".form-h2").jqTransform();
	$(".colorbox").colorbox();
	$(".submit-button").click(function(evt) {
		evt.preventDefault();
		if(validatePage(pages[currentQuestionIndex])) {
			var ratingValue = 0;
		$(".B input").each(function() {
			if(this.checked) ratingValue = ratingValue + parseFloat($(this).val());
		});
		$("#rating_information_security_tools").val(ratingValue);
		ratingValue = 0;
		$(".C input").each(function() {
			if(this.checked) ratingValue = ratingValue + parseFloat($(this).val());
		});
		$("#rating_prevention_response").val(ratingValue);
		ratingValue = 0;
		$(".D input").each(function() {
			if(this.checked) ratingValue = ratingValue + parseFloat($(this).val());
		});
		$("#rating_detection").val(ratingValue);
		// $(".F input").each(function() {
		// 	if(this.checked) ratingValue = ratingValue + parseFloat($(this).val());
		// });
		
		$(".form-h2").get(0).submit();
		} else {
			alert("Please fill out all fields before moving on.");
		}
	});
	
});

function resetQuestionBG() {
	$(".question-wrapper").css("background","transparent");
}

function validatePage(which) {
		var radioButtons = new Object();
		var emptyField = false;
		var hasCheckbox = false;
		var checkboxChecked = false;
		which.find("select").each(function() {
			if($(this).val()=="") {
				emptyField = true;
			}
		});
		which.find("input").each(function() {
			if($(this).attr("type")=="radio") {
				if(radioButtons[$(this).attr("name")]==null) {
					if(this.checked) {
						radioButtons[$(this).attr("name")] = true;
					} else {
						radioButtons[$(this).attr("name")] = false;
					}
				} else {
					if(this.checked) {
						radioButtons[$(this).attr("name")] = true;
					}
				}
			} else if($(this).attr("type")=="checkbox") {
				hasCheckbox = true;
				//if(this.checked) checkboxChecked = true;
				checkboxChecked = true;
			} else {
				if($(this).val()=="") {
					emptyField = true;
				}
			}
		});
		var radioBlank = false;
		for(radioButton in radioButtons) {
			if(radioButtons[radioButton] == false) radioBlank = true;
		}		if(radioBlank || emptyField || (hasCheckbox && !checkboxChecked)) {
			return false;
		}
		return true;
	}
