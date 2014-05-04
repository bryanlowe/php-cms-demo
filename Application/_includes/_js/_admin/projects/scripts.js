$(document).ready(function(){
	$('#projects_select').change(function(){
		projects_select();
	});
	$('#clients_select').change(function(){
		$('#client_id').val($(this).val());
		if($(this).val() != ''){
			reloadFormElement('project_tags_container', 'projects', $('#client_id').val());
			if($('#projects_select').val() == ""){
				disableElement('project_tags', true);
				disableElement('addTagBtn', true);
			}
		} else {
			reloadFormElement('project_tags_container', 'projects');
			if($('#projects_select').val() == ""){
				disableElement('project_tags', true);
				disableElement('addTagBtn', true);
			}
		}
	});
	$('#submitBtn').click(function(){
		saveDoc('projects',true);
	});
	$('#deleteBtn').click(function(){
		deleteDoc('projects',true);
	});
	$('#resetBtn').click(function(){
		reloadPageElements('projects',false);
	});
	$('#addTagBtn').click(function(){
		if($('#project_tags').val() != ''){
			addProjectTag();
		}		
	});
	disableElement('project_tags', true);
	disableElement('addTagBtn', true);
});

function projects_select(){
	statusApp.showPleaseWait();
	updateForm($('#projects_select').val(),'projects',['mongoid','client_id','project_title','project_status','project_description']);
	if($('#projects_select').val() != ''){
		disableElement('clients_select', true);
		disableElement('project_tags', false);
		disableElement('addTagBtn', false);
		reloadFormElement('project_tags_container', 'projects', $('#client_id').val());
		reloadFormElement('current_tags', 'projects', $('#projects_select').val());
	} else {
		disableElement('clients_select', false);
		disableElement('project_tags', true);
		disableElement('addTagBtn', true);
		reloadFormElement('project_tags_container', 'projects');
		reloadFormElement('current_tags', 'projects');
	}
	statusApp.hidePleaseWait();
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
  	$('#'+collection+'_form')[0].reset();
  	$('#'+collection+'_form #_id').val('');
  	$('#client_id').val('');
  	$('#'+collection+'_select').prop('selectedIndex',0);
  	$('#clients_select').prop('selectedIndex',0);
  	disableElement('clients_select', false);
  	reloadFormElement('project_tags_container', 'projects');
  	reloadFormElement('current_tags', 'projects');
  	disableElement('project_tags', true);
	disableElement('addTagBtn', true);
  	if(ajax){
  		reloadFormElement('projects_select_container','projects');
		$('#projects_select').change(function(){
			projects_select();
		});
  	}
}

/**
 * Function updates the form with database information
 *
 * @param _id - mongo id number
 * @param collection - mongo collection
 * @param fields - mongo key attributes to be collected
 */
function updateForm(_id, collection, fields){
  if(_id != ''){
    var mongoid = false;
    if($.inArray('mongoid',fields) > -1){mongoid = true;}
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: site_url+collection,
        async: false,
        data: {_id: _id, collection: collection, mongoid: mongoid, _ajaxFunc: "getEntry"}
    });
    var formValues = $.parseJSON(result.responseText);
    $('#'+collection+'_form')[0].reset();
    for(var i = 0; i < fields.length; i++){
      if(fields[i] == 'mongoid'){
        $('#'+collection+'_form #_id').val(formValues._id['$id']);
      } else if(fields[i] == 'client_id'){
        $('#'+collection+'_form #client_id').val(formValues.client_id['$id']);
        $('#clients_select').val(formValues.client_id['$id']);
        $('#clients_select').change();
        disableElement('clients_select', true);
      } else {
        $('#'+collection+'_form #'+fields[i]).val(formValues[fields[i]]);
      }
    }
  } else {
    $('#'+collection+'_form')[0].reset();
    $('#'+collection+'_form #_id').val('');
    $('#'+collection+'_form #client_id').val('');
    $('#clients_select').val('');
    $('#clients_select').change();
  }
}

/**
 * Adds a project tag to this project
 */
function addProjectTag(){
	var docObj = {};
	docObj.url = 'projects',
	docObj.collection = 'projects',
	docObj.set = 'project_tags',
	docObj.values = {},
	docObj._id = $('#projects_select').val();
	docObj.values = $('#project_tags').val();
	docObj.mongoid = 1;
	addSetToDoc(docObj);
	reloadFormElement('current_tags', 'projects', $('#projects_select').val());
}

/**
 * Removes a project tag from the project
 */
function removeProjectTag(tag){
  var docObj = {};
  docObj.url = 'projects',
  docObj.collection = 'projects',
  docObj.set = 'project_tags',
  docObj.values = tag;
  docObj._id = $('#projects_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('current_tags', 'projects', $('#projects_select').val());
}