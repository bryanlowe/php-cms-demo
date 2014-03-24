$(document).ready(function(){
	$('#projects_select').change(function(){
		updateForm($(this).val(),'projects',['mongoid','client_id','project_tag','project_description']);
		$('#timeline-desc').html('<p align="center">Nothing to show</p>');
		if($(this).val() != ''){
			disableElement('clients_select', true);
			disableElement('description', false);
			reloadFormElement('tag_select_container', 'projects', $('#client_id').val());
			$('#tag_select_container').show();	
			$('#tag_select').change(function(){
				$('#project_tag').val($(this).val());
			});
			reloadFormElement('timeline-list', 'projects', $('#projects_select').val());
		} else {
			disableElement('clients_select', false);
			disableElement('description', true);
			$('#tag_select_container').hide();
			reloadFormElement('tag_select_container', 'projects');
			reloadFormElement('timeline-list', 'projects');
		}
	});
	$('#clients_select').change(function(){
		$('#client_id').val($(this).val());
		$('#project_tag').val('');
		if($(this).val() != ''){
			reloadFormElement('tag_select_container', 'projects', $(this).val());
			$('#tag_select_container').show();	
			$('#tag_select').change(function(){
				$('#project_tag').val($(this).val());
			});
		} else {
			$('#tag_select_container').hide();
			reloadFormElement('tag_select_container', 'projects');
		}
	});
	$('#submitBtn').click(function(){
		disableElement('project_tag', false);
		saveDoc('projects',true);
		disableElement('project_tag', true);
	});
	$('#deleteBtn').click(function(){
		deleteDoc('projects',true);
	});
	$('#resetBtn').click(function(){
		reloadPageElements('projects',false);
	});
	$('#updateBtn').click(function(){
		if($('#description').val() != ''){
			var d = new Date();
			var docObj = {};
			docObj.url = 'projects',
			docObj.collection = 'projects',
			docObj.set = 'project_timeline',
			docObj.values = {},
			docObj._id = $('#projects_select').val();
			docObj.values.description = $('#description').val();
			addSetToDoc(docObj);
			$('#description').val('');
			reloadFormElement('timeline-list', 'projects', $('#projects_select').val());
		}		
	});
	disableElement('project_tag', true);
	disableElement('description', true);
	$('#tag_select_container').hide();
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
  	$('#'+collection+'_form')[0].reset();
  	$('#'+collection+'_form #_id').val('');
  	$('#client_id').val('');
  	$('#'+collection+'_select').prop('selectedIndex',0);
  	$('#clients_select').prop('selectedIndex',0);
  	$('#tag_select_container').hide();
	reloadFormElement('tag_select_container', 'projects');
	reloadFormElement('timeline-list', 'projects');
  	disableElement('clients_select', false);
  	disableElement('description', true);
  	$('#timeline-desc').html('<p align="center">Nothing to show</p>');
  	if(ajax){
  		reloadFormElement('projects_select_container','projects');
		$('#projects_select').change(function(){
			updateForm($(this).val(),'projects',['mongoid','client_id','project_tag','project_description']);
			if($(this).val() != ''){
				disableElement('clients_select', true);
				disableElement('description', false);
				reloadFormElement('tag_select_container', 'projects', $('#client_id').val());
				$('#tag_select_container').show();	
				$('#tag_select').change(function(){
					$('#project_tag').val($(this).val());
				});
			} else {
				disableElement('clients_select', false);
				disableElement('description', true);
				$('#tag_select_container').hide();
				reloadFormElement('tag_select_container', 'projects');
			}
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
      } else {
        $('#'+collection+'_form #'+fields[i]).val(formValues[fields[i]]);
      }
    }
  } else {
    $('#'+collection+'_form')[0].reset();
    $('#'+collection+'_form #_id').val('');
    $('#'+collection+'_form #client_id').val('');
  }
}