$(document).ready(function(){
	refreshBLLSelectOptions("#clients_form select#client_id", "clients", site_url+"admin/clients", "company", "client_id", "company ASC");
	$("#clients_form select#client_id").change(function(){
		updateBLLFormFields('clients_form','clients',site_url+'admin/clients');
	});
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	refreshBLLSelectOptions("#clients_form select#client_id", "clients", site_url+"admin/clients", "company", "client_id", "company ASC");
	$("#clients_form")[0].reset();
}

/**
 * Saves the client form
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
	    	popUpMsg("Client was saved successfully!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}

/**
 * Delete the client form
 */
function deleteClient(){
	var result = "";
	$.prompt("<p>Are you sure you want to delete this client?</p><p>If you delete this client all invoices and projects associated with the project will be deleted as well.</p>", {
		title: "Are you sure?",
		buttons: { "Yes": true, "No": false },
		submit: function(e,v,m,f){ 
			if(v){
				result = deleteEntry('Clients');
				if(result == "Deletion Success"){
					reloadPageElements();	
				}
			}
			$.prompt.close();
		}
	});
}