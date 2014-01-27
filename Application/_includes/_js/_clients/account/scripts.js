$(document).ready(function(){
	$("#client_name_container").insertBefore($("#company_container"));
	$("#client_name_container label").html("Name");
	$("#client_id_container").remove();
	$("#clients_form").append('<input type="hidden" class="primaryKey" id="client_id" />')
	$("#client_id").val($("#client_id_holder").val())
	$("#client_rate_container").hide();
	$("#client_rate").attr("readonly",true);
	$(".deleteBtn_container").remove();
	$("input[name='saveBtn']").val("UPDATE");
	updateBLLFormFields('clients_form','clients',site_url+'account');
});

/**
 * Saves the account form
 */
function saveClient(){
	var results = saveEntry('Clients');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'clients');
    		return false;
	  	} else if(results[0] == 'duplicate'){
	    	popUpMsg("This client already exists!");
	    	return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Your account was saved successfully!");
	    	return true;
	  	}
	}
}