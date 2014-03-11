$(document).ready(function(){
	$('#users_select').change(function(){
		updateForm($(this).val(),'users',['mongoid','fullname','password','email','type','status']);
	});
	$('#submitBtn').click(function(){
		if(saveDoc('users',true)){
			reloadFormElement('users_select_container','users');
			reloadFormElement('client-list','users');
			$('#users_select').change(function(){
				updateForm($(this).val(),'users',['mongoid','fullname','password','email','type','status']);
			});
		}
	});
	$('#deleteBtn').click(function(){
		deleteDoc('users',true);
		reloadFormElement('users_select_container','users');
		reloadFormElement('client-list','users');
		$('#users_select').change(function(){
			updateForm($(this).val(),'users',['mongoid','fullname','password','email','type','status']);
		});
	});
	$('#resetBtn').click(function(){
		reloadPageElements('users');
		reloadFormElement('users_select_container','users');
		reloadFormElement('client-list','users');
		$('#users_select').change(function(){
			updateForm($(this).val(),'users',['mongoid','fullname','password','email','type','status']);
		});
	});
});

/**
 * Function updates the user form with client information
 *
 * @param clientid - mongo client id number
 * @param collection - mongo collection
 * @param fields - mongo key attributes to be collected
 */
function clientToUserForm(clientid){
  if(clientid != ''){
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: site_url+'users',
        async: false,
        data: {_id: clientid, collection: 'clients', mongoid: true, _ajaxFunc: "getDocByID"}
    });
    var formValues = $.parseJSON(result.responseText);
    $('#users_form')[0].reset();
    $('#users_form #_id').val(formValues._id['$id']);
    $('#users_form #fullname').val(formValues.client_name);
    $('#users_form #email').val(formValues.email);
    $('#users_form #type').val('CLIENT');
    $('#users_form #status').val(1);
  }
}