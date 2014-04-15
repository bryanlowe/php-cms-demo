$(document).ready(function(){
	$("#description_container").addClass('col-xs-12');
	$("#description").prop('rows', 15);
	$('#submitBtn').click(function(){
		saveOrder();
	});
});

/**
 * Saves the order form
 */
function saveOrder(){
	if(validateForm('place_order_form') != false){
		statusApp.showPleaseWait();
	    var docObj = createDocFromForm('place_order_form');
	    var results = $.ajax({
		    type: "POST",
		    url: site_url+'orders',
		    async: false,
		    data: {doc: docObj, _ajaxFunc: "saveEntry"}
		});
	    results = $.parseJSON(results.responseText);
	  	statusApp.hidePleaseWait();
	    if(results.err == null){
	      popUpMsg("Your order has been placed!");
	      $("#place_order_form")[0].reset();
	      return true;
	    } else {
	      popUpMsg(results.err);
	      return false;
	    }
	}
	return false;
}