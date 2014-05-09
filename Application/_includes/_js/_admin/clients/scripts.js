$(document).ready(function(){
	$('#zip_container').css('padding-left', '30px');
    $('#client_name_container').addClass('col-lg-offset-2');
    $('#phone_number_container').addClass('col-lg-offset-2');
    $('#city_container').addClass('col-lg-offset-2');
    $('#zip_container').addClass('col-lg-offset-2');
	$('#clients_select').change(function(){
		clients_select();
	});
	$('#submitBtn').click(function(){
		saveDoc('clients',true);
	});
	$('#resetBtn').click(function(){
		reloadPageElements('clients',false);
	});
	$('#addBtn').click(function(){
		if($('#project_tag').val() != ''){
			var docObj = {};
			docObj.url = 'clients',
			docObj.collection = 'clients',
			docObj.set = 'project_tags',
			docObj.values = $('#project_tag').val();
			docObj._id = $('#clients_select').val();
			docObj.mongoid = 1;
			addSetToDoc(docObj);
			$('#project_tag').val('');
			reloadFormElement('project-tag-list', 'clients', $('#clients_select').val());
		}
		
	});
	disableElement('project_tag', true);
});

function clients_select(){
	updateForm($('#clients_select').val(),'clients',['mongoid','company','client_name','email','phone_number','address','city','state','zip','client_rate']);
	$('#project_tag').val('');
	if($('#clients_select').val() != ''){
		disableElement('project_tag', false);
		reloadFormElement('project-tag-list', 'clients', $('#clients_select').val());
	} else {
		disableElement('project_tag', true);
		reloadFormElement('project-tag-list', 'clients', 0);
	}
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
  	$('#'+collection+'_form')[0].reset();
  	$('#'+collection+'_form #_id').val('');
  	$('#'+collection+'_select').prop('selectedIndex',0);
  	disableElement('project_tag', true);
  	reloadFormElement('project-tag-list', 'clients', 0);
  	if(ajax){
  		reloadFormElement('clients_select_container','clients');
		$('#clients_select').change(function(){
			clients_select();
		});
		reloadFormElement('project-tag-list','clients',0);
  	}
}

/**
 * Removes an timeline event from the database
 */
function removeProjectTag(tag){
  var docObj = {};
  docObj.url = 'clients',
  docObj.collection = 'clients',
  docObj.set = 'project_tags',
  docObj.values = tag;
  docObj._id = $('#clients_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('project-tag-list', 'clients', $('#clients_select').val());
}