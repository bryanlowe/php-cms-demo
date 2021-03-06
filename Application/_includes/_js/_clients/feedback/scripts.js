$(document).ready(function(){
	$("#description_container").addClass('col-xs-12');
	$("#description").prop('rows', 15);
	$('#submitBtn').click(function(){
		saveFeedback();
	});
	$('#anonymous_select').change(function(){
		if($(this).val() > 0){
			$("#projects_select").prop('disabled', false);	
		} else {
			$("#projects_select").val('');	
			$("#projects_select").prop('disabled', true);	
		}
	});
});

/**
 * Saves the feedback form
 */
function saveFeedback(){
	if(validateForm('feedback_form') != false){
		statusApp.showPleaseWait();
	    var docObj = createDocFromForm('feedback_form');
	    docObj.project_id = $('#projects_select').val();
	    docObj.anonymous = $('#anonymous_select').val();
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
	      return true;
	    } else {
	      popUpMsg(results.err);
	      return false;
	    }
	}
	return false;
}