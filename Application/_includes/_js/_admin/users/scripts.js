$(document).ready(function(){
	refreshBLLSelectOptions("#users_form select#user_id", "users", site_url+"admin/users", "email", "user_id", "email ASC");
	refreshBLLSelectOptions("#users_form select#user_group_id", "user_group", site_url+"admin/users", "group_name", "user_group_id", "group_name ASC");
	refreshBLLSelectOptions("#clients_form select#client_id", "clients", site_url+"admin/users", "company", "client_id", "company ASC");
	$('#users_form select#user_id').change(function(){
		updateBLLFormFields('users_form','users',site_url+'admin/users');
	});
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	refreshBLLSelectOptions("#users_form select#user_id", "users", site_url+"admin/users", "email", "user_id", "email ASC");
	$("#users_form")[0].reset();
	$("#clients_form")[0].reset();
}

/**
 * Saves the user form
 */
function saveUser(){
	var results = saveEntry('Users');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'users');
    		return false;
	  	} else if(results[0] == 'duplicate'){
	    	popUpMsg("This user already exists!");
	    	return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("User was saved successfully!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}

/**
 * Delete the project form
 */
function deleteUser(){
	var result = "";
	$.prompt("<p>Are you sure you want to delete this user?</p>", {
		title: "Are you sure?",
		buttons: { "Yes": true, "No": false },
		submit: function(e,v,m,f){ 
			if(v){
				result = deleteEntry('Users');
				if(result == "Deletion Success"){
					reloadPageElements();	
				}
			}
			$.prompt.close();
		}
	});
}

/**
 * Function updates the user form with client information
 */
function updateUserForm(){
  var client_id = $('#client_id').val();
  var result = $.ajax({
      type: "POST",
      dataType: "json",
      url: site_url+"admin/users",
      async: false,
      data: {table: 'clients', primaryKey: client_id, bllAction: "SELECTION", _ajaxFunc: "gatherBLLResource"}
  });

  var formValues = $.parseJSON(result.responseText);
  formValues = formValues[0];
  $('#users_form')[0].reset();
  $('#user_name').val(formValues['client_name']);
  $('#email').val(formValues['email']);
  $('#user_group_id').val(3);
  $('#status').val(1);
}