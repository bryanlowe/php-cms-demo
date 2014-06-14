$(document).ready(function(){
	$('#clients_select').change(function(){
		clients_select();
	});
});

function clients_select(){
	statusApp.showPleaseWait();
	if($('#clients_select').val() != ''){
		reloadFormElement('resource-list', 'client-resources', $('#clients_select').val());
	} else {
		reloadFormElement('resource-list', 'client-resources', 0);
	}
	statusApp.hidePleaseWait();
}

/**
 * Removes an timeline event from the database
 */
function removeResource(resource){
	statusApp.showPleaseWait();
  	var results = $.ajax({
	    type: "POST",
	    url: site_url+'client-resources',
	    async: false,
	    data: {_id: $('#clients_select').val(), filename: resource, _ajaxFunc: "removeResource"}
	});
  	reloadFormElement('resource-list', 'client-resources', $('#clients_select').val());
  	statusApp.hidePleaseWait();
}