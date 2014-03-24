$(document).ready(function(){
	$('#clients_select').change(function(){
		updateForm($(this).val(),'clients',['mongoid','company','client_name','email','phone_number','client_rate']);
		$('#project_tag').val('');
		if($(this).val() != ''){
			disableElement('project_tag', false);
			reloadFormElement('project-tag-list', 'clients', $(this).val());
		} else {
			disableElement('project_tag', true);
			reloadFormElement('project-tag-list', 'clients', 0);
		}
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
			addSetToDoc(docObj);
			$('#project_tag').val('');
			reloadFormElement('project-tag-list', 'clients', $('#clients_select').val());
		}
		
	});
	disableElement('project_tag', true);
});

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
			updateForm($(this).val(),'clients',['mongoid','company','client_name','email','phone_number','client_rate']);
		});
		reloadFormElement('project-tag-list','clients',0);
  	}
}

/**
 * Reloads the element by Dom ID and ajax
 *
 * @param id - dom id
 * @param url - site url for ajax
 */
function reloadFormElement(id, url, clientID){
  if(id != ''){
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: site_url+url,
        async: false,
        data: {dom_id: id, clientID: clientID, _ajaxFunc: "renderPageElement"}
    });
    $('#'+id).html(result.responseText);
  }
}