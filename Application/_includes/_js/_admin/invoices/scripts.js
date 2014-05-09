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
  disableElement('projects_select', true);
  disableElement('addBtn', true);
});

function invoices_select(){
  statusApp.showPleaseWait();
  updateForm($('#invoices_select').val(),'invoices',['mongoid','client_id','invoice_number','wp_invoice_id','invoice_cost','invoice_description']);
  if($('#invoices_select').val() != ''){
    disableElement('projects_select', false);
    disableElement('addBtn', false);
    reloadFormElement('toggleInvoice','invoices',$('#invoices_select').val());
    reloadFormElement('current_projects', 'invoices', $('#invoices_select').val());
  } else {
    disableElement('projects_select', true);
    disableElement('addBtn', true);
    reloadFormElement('toggleInvoice','invoices');
    reloadFormElement('current_projects', 'invoices');
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