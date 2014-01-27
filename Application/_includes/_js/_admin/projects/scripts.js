$(document).ready(function(){
	refreshBLLSelectOptions("#projects_form select#project_id", "projects", site_url+"projects", "project_title", "project_id", "project_title ASC");
	refreshBLLSelectOptions("#projects_form select#client_id", "clients", site_url+"projects", "company", "client_id", "company ASC");
	$('#projects_form select#project_id').change(function(){
		updateBLLFormFields('projects_form','projects',site_url+'projects'); 
		updateProjectStatusForm($(this).val());
	});
    $('#project_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
    $('#project_status_form input[name="saveBtn"]').addClass('disabled');
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	refreshBLLSelectOptions("#projects_form select#project_id", "projects", site_url+"projects", "project_title", "project_id", "project_title ASC");
	$("#projects_form")[0].reset();
	$("#project_status_form")[0].reset();
	$('#project_status_form #project_status_date').val('');
    $('#project_status_form #project_status_id').val('');
}

/**
 * Saves the project form
 */
function saveProject(){
	var results = saveEntry('Projects');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'projects');
    		return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Project was saved successfully!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}

/**
 * Saves the project status form
 */
function saveStatus(){
	var results = saveEntry('project_status');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'project_status');
    		return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Project status was saved successfully!");
	    	return true;
	  	}
	}
}

/**
 * Delete the project form
 */
function deleteProject(){
	var result = "";
	$.prompt("<p>Are you sure you want to delete this project?</p><p>If you delete this project, the project status will be deleted as well.</p>", {
		title: "Are you sure?",
		buttons: { "Yes": true, "No": false },
		submit: function(e,v,m,f){ 
			if(v){
				result = deleteEntry('Projects');
				if(result == "Deletion Success"){
					reloadPageElements();	
				}
			}
			$.prompt.close();
		}
	});
}

/**
  * Update form fields by database entry
  *
  * @param projectID 
  */
function updateProjectStatusForm(projectID){
	projectID = (projectID != "") ? projectID : 0;
    var statusResult = $.ajax({
        type: "POST",
        dataType: "json",
        url: '/admin/projects',
        async: false,
        data: {projectID: projectID, _ajaxFunc: "getProjectStatus"}
    });

    var statusFormValues = $.parseJSON(statusResult.responseText);
    statusFormValues = statusFormValues[0];
    if(typeof(statusFormValues) != "undefined"){
      $('#project_status_form #project_status_id').val(statusFormValues['project_status_id']);
      $('#project_status_form #project_id').val(statusFormValues['project_id']);
      $('#project_status_form #status').val(statusFormValues['status']);
      $('#project_status_form #description').val(statusFormValues['description']);
      $('#project_status_form #project_status_date').val(statusFormValues['project_status_date']);
      $('#project_status_form input[name="saveBtn"]').removeAttr('disabled');
      $('#project_status_form input[name="saveBtn"]').removeClass('disabled');
    } else {
      $('#project_status_form')[0].reset();
      $('#project_status_form #project_status_date').val('');
      $('#project_status_form #project_status_id').val('');
      if(projectID == 0){
        $('#project_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
        $('#project_status_form input[name="saveBtn"]').addClass('disabled');
      } else {
        $('#project_status_form #project_id').val(projectID);
        $('#project_status_form input[name="saveBtn"]').removeAttr('disabled');
        $('#project_status_form input[name="saveBtn"]').removeClass('disabled');
      }
    }
}