$(document).ready(function(){
	$("#projects_select").change(function(){
		if($(this).val() != ""){
			reloadFormElement('writers_select_container', 'feedback', $("#projects_select").val());
		} else {
			reloadFormElement('writers_select_container', 'feedback');
		}
		$('#writers_select').change(function(){
			writers_select();
		});
		writers_select();
	});
	$("#description_container").addClass('col-xs-12');
	$("#description").prop('rows', 15);
	$('#submitBtn').click(function(){
		saveFeedback();
	});
	writers_select();
	$('.toggleDesc').click(function(){
		var feedbackID = $(this).attr('id').split('feedback_')[1];
		$('#writer-feedback').html($('#details_'+feedbackID).html());
	});
	$("#feedbackHistoryTbl").tablesorter();
});

function writers_select(){
	if($('#writers_select').val() != ''){
		$("#description").prop('disabled', false);
		$("input[name='rating']").prop('disabled', false);
		$("#words_per_hour").prop('disabled', false);
	} else {
		$("#description").prop('disabled', true);
		$("#description").val('');
		$("input[name='rating']").prop('checked', false);
		$("input[name='rating']").prop('disabled', true);
		$("#words_per_hour").val('');
		$("#words_per_hour").prop('disabled', true);
	}
}

/**
 * Saves the feedback form
 */
function saveFeedback(){
	if(validateForm('feedback_form') != false){
		statusApp.showPleaseWait();
	    var docObj = createDocFromForm('feedback_form');
	    docObj.project_id = $('#projects_select').val();
	    docObj.writer_id = $('#writers_select').val();
	    var results = $.ajax({
		    type: "POST",
		    url: site_url+'feedback',
		    async: false,
		    data: {doc: docObj, _ajaxFunc: "saveEntry"}
		});
	    results = $.parseJSON(results.responseText);
	  	statusApp.hidePleaseWait();
	    if(results.err == null){
	      popUpMsg("Thank you for your feedback!");
	      $("#feedback_form")[0].reset();
	      $('#projects_select').prop('selectedIndex',0);
	      $('#projects_select').change();
	      return true;
	    } else {
	      popUpMsg(results.err);
	      return false;
	    }
	}
	return false;
}