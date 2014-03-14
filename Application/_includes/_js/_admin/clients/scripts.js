$(document).ready(function(){
	$('#clients_select').change(function(){
		updateForm($(this).val(),'clients',['mongoid','company','client_name','email','phone_number','client_rate']);
	});
	$('#submitBtn').click(function(){
		saveDoc('clients',true);
	});
	$('#deleteBtn').click(function(){
		deleteDoc('clients',true);
	});
	$('#resetBtn').click(function(){
		reloadPageElements('clients');
	});
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection){
  	$('#'+collection+'_form')[0].reset();
  	$('#'+collection+'_form #_id').val('');
  	$('#'+collection+'_select').prop('selectedIndex',0);
  	reloadFormElement('clients_select_container','clients');
	$('#clients_select').change(function(){
		updateForm($(this).val(),'clients',['mongoid','company','client_name','email','phone_number','client_rate']);
	});
}