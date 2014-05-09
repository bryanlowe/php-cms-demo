$(document).ready(function(){
	$('#invoices_select').change(function(){
      invoices_select();
  });
  $('#clients_select').change(function(){
    $('#client_id').val($(this).val());
    if($(this).val() != ""){
      reloadFormElement('projects_select_container', 'invoices', $('#clients_select').val());
      if($('#invoices_select').val() == ""){
        disableElement('projects_select', true);
        disableElement('addBtn', true);
      }
    } else {
      reloadFormElement('projects_select_container', 'invoices');
      if($('#invoices_select').val() == ""){
        disableElement('projects_select', true);
        disableElement('addBtn', true);
      }
    }
  });
  $('#submitBtn').click(function(){
    disableElement('description', true);
    saveDoc('invoices',true);
  });
  $('#deleteBtn').click(function(){
    deleteDoc('invoices',true);
  });
  $('#resetBtn').click(function(){
    reloadPageElements('invoices',false);
  });
  $('#addBtn').click(function(){
    if($('#projects_select').val() != ""){
      addProject();
    }
  });
  $('#invoice_status').change(function(){
    if($(this).val() != ""){
      if($(this).val() == "PAID"){
        $('#paidBtn').prop('disabled', false);
        $('#paidBtn').addClass('btn-glow-success');
        $('#unpaidBtn').prop('disabled', true);
        $('#unpaidBtn').removeClass('btn-glow-danger');
      } else {
        $('#paidBtn').prop('disabled', true);
        $('#paidBtn').removeClass('btn-glow-success');
        $('#unpaidBtn').prop('disabled', false);
        $('#unpaidBtn').addClass('btn-glow-danger');
      }
    } else {
      $('#paidBtn').prop('disabled', true);
      $('#paidBtn').removeClass('.btn-glow-success');
      $('#unpaidBtn').prop('disabled', true);
      $('#unpaidBtn').removeClass('.btn-glow-danger');
    }
  });
  /*
  var new_site_url = site_url.replace('/admin/','/');
	$('#file_upload').uploadify({
		'formData'     : {
			'TARGET_DEST': '/Media/_documents/_invoices',
			'timestamp' : timestamp,
			'token'     : token
		},
    'multi'    : false,
		'buttonText' : 'SELECT INVOICE FILE',
		'buttonClass' : 'btn btn-success',
		'fileTypeDesc' : 'Invoice Files',
    'fileTypeExts' : '*.doc; *.pdf;', 
		'swf'      : new_site_url+'Utilities/uploadify/uploadify.swf',
		'uploader' : new_site_url.replace('https','http')+'/Utilities/uploadify/uploadify.php',
		'onUploadSuccess' : function(file, data, response) {
      statusApp.showPleaseWait();
      var docObj = {};
      docObj.values = {},
      docObj._id = $('#invoices_form #_id').val(),
      docObj.url = site_url+'invoices',
      docObj.collection = 'invoices',
      docObj.mongoid = 1;
      docObj.values.invoice_filename = file.name;
      var results = saveEntry(docObj);
      statusApp.hidePleaseWait();
      if(results.err == null){
        reloadFormElement('file_link', 'invoices', $('#invoices_select').val());
        popUpMsg("File upload was successful!");
        return true;
      } else {
        popUpMsg(results.err);
        return false;
      }
    },
    'onSWFReady' : function() {
        $('#file_upload').uploadify('disable', true);
    } 
	});
	$('#file_upload-button').attr('style', '');
  $('<div id="file_link" class="list-group col-lg-5" style="margin-left:10px;"></div>').insertAfter('#file_upload_container');
  */
  disableElement('projects_select', true);
  disableElement('addBtn', true);
});

function invoices_select(){
  statusApp.showPleaseWait();
  updateForm($('#invoices_select').val(),'invoices',['mongoid','client_id','invoice_number','wp_invoice_id','invoice_cost','invoice_description']);
  if($('#invoices_select').val() != ''){
    disableElement('projects_select', false);
    disableElement('addBtn', false);
    $("#file_upload").uploadify("disable",false);
    reloadFormElement('toggleInvoice','invoices',$('#invoices_select').val());
    reloadFormElement('current_projects', 'invoices', $('#invoices_select').val());
    //reloadFormElement('file_link', 'invoices', $('#invoices_select').val());
  } else {
    disableElement('projects_select', true);
    disableElement('addBtn', true);
    $("#file_upload").uploadify("disable",true);
    reloadFormElement('toggleInvoice','invoices');
    reloadFormElement('current_projects', 'invoices');
    //reloadFormElement('file_link', 'invoices');
  }
  statusApp.hidePleaseWait();
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
  statusApp.showPleaseWait();
  $('#'+collection+'_form')[0].reset();
  $('#'+collection+'_form #_id').val('');
  $('#client_id').val('');
  $('#'+collection+'_select').prop('selectedIndex',0);
  $('#clients_select').prop('selectedIndex',0);
  $('#projects_select').prop('selectedIndex',0);
  disableElement('clients_select', false);
  reloadFormElement('projects_select_container','invoices');
  reloadFormElement('toggleInvoice','invoices');
  reloadFormElement('current_projects', 'invoices');
  disableElement('projects_select', true);
  disableElement('addBtn', true);
  $("#file_upload").uploadify("disable",true);
  //reloadFormElement('file_link', 'invoices');
  if(ajax){
    reloadFormElement('invoices_select_container','invoices');
    $('#invoices_select').change(function(){
      invoices_select();
    });
  }
  statusApp.hidePleaseWait();
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
  }
}

/**
 * Adds a project to the project list
 */
function addProject(){
  var docObj = {};
  docObj.url = 'invoices',
  docObj.collection = 'invoices',
  docObj.set = 'project_list',
  docObj.values = {},
  docObj._id = $('#invoices_select').val();
  docObj.values = $('#projects_select').val();
  docObj.mongoid = 1;
  addSetToDoc(docObj);
  reloadFormElement('current_projects', 'invoices', $('#invoices_select').val());
  reloadFormElement('projects_select_container', 'invoices', $('#clients_select').val());
}

/**
 * Removes a project from the project list
 */
function removeProject(projectID){
  var docObj = {};
  docObj.url = 'invoices',
  docObj.collection = 'invoices',
  docObj.set = 'project_list',
  docObj.values = projectID;
  docObj._id = $('#invoices_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('current_projects', 'invoices', $('#invoices_select').val());
  reloadFormElement('projects_select_container', 'invoices', $('#clients_select').val());
}

/**
 * Remove invoice file from media 
 
function destroyInvoiceFile(_id){
  statusApp.showPleaseWait();
  var result = $.ajax({
    type: "POST",
    url: site_url+"invoices",
    async: false,
    data: {_id: _id, _ajaxFunc: "removeInvoiceFile"}
  });
  statusApp.hidePleaseWait();
  if(result.responseText != 'pass'){
    popUpMsg(result.responseText);  
  } else {
    reloadFormElement('file_link', 'invoices', $('#invoices_select').val());
    popUpMsg('Invoice file successfully deleted.');
  }
}
*/