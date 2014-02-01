$(document).ready(function(){
	$("#client_id").val($("#client_id_holder").val());
	$("#description").attr('rows', '15');
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	$("#orders_form")[0].reset();
}

/**
 * Saves the order form
 */
function saveOrder(){
	var results = saveEntry('Orders');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'orders');
    		return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Your order has been submitted!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}