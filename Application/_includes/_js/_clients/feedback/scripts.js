$(document).ready(function(){
	$("#client_id").val($("#client_id_holder").val());
	$("#description").attr('rows', '15');
	$("#anonymous_1").click(function(){
		if($(this).is(":checked")){
			$("#client_id").val(0);	
			$("#project").val("");
			$("#project").attr('disabled', true);
		} else {
			$("#client_id").val($("#client_id_holder").val());	
			$("#project").val("");
			$("#project").attr('disabled', false);
		}
	});
	var select = $("#project").prop("options");
    var optJSON = $.parseJSON(clientProjects);
    $.each(optJSON, function(i, opt) {
        select[select.length] = new Option(opt['project_title'], opt['project_title']);
    });
    $("#project_container").append('<br />');
    $("#description_container").append('<br />');
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	$("#feedback_form")[0].reset();
	$("#client_id").val($("#client_id_holder").val());
}

/**
 * Saves the order form
 */
function saveFeedback(){
	var description = $("#description").val();
	if($("#project").val() != ""){
		var projectTitle = "Project Title: " + $("#project").val() + " -- \n\n";
		if(description.indexOf(projectTitle) != 0){
			description = projectTitle + description;
			$("#description").val(description);
		}
	}
	var results = saveEntry('feedback');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'feedback');
    		return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Your feedback has been submitted!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}