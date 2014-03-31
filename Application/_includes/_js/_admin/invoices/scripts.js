$(document).ready(function(){
  $('#invoice_history_container').insertAfter('#invoice_description_container');
	$('#invoices_select').change(function(){
      invoices_select($(this).val());
  });
  $('#clients_select').change(function(){
    $('#client_id').val($(this).val());
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
  $('#updateBtn').click(function(){
    if($('#description').val() != ''){
      var d = new Date();
      var docObj = {};
      docObj.url = 'invoices',
      docObj.collection = 'invoices',
      docObj.set = 'invoice_history',
      docObj.values = {},
      docObj._id = $('#invoices_select').val();
      docObj.values.description = $('#description').val();
      docObj.mongoid = 1;
      addSetToDoc(docObj);
      $('#description').val('');
      reloadFormElement('status-list', 'invoices', $('#invoices_select').val());
    }   
  });
  disableElement('description', true);
  $('#deleteFileBtn').click(function(){
    if($('#invoices_select').val() != ''){
      destroyInvoiceFile($('#invoices_select').val());
    }
  });
  var new_site_url = site_url.replace('/admin/','/');
	$('#file_upload').uploadify({
		'formData'     : {
			'TARGET_DEST': '/Media/_documents/_invoices',
			'timestamp' : timestamp,
			'token'     : token
		},
		'buttonText' : 'SELECT INVOICE FILE',
		'buttonClass' : 'btn btn-success',
		'fileTypeDesc' : 'Invoice Files',
    'fileTypeExts' : '*.doc; *.pdf;', 
		'swf'      : new_site_url+'Utilities/uploadify/uploadify.swf',
		'uploader' : new_site_url.replace('https','http')+'/Utilities/uploadify/uploadify.php',
		'onUploadSuccess' : function(file, data, response) {
			$('#invoice_file_link').html(file.name);
			$('#invoice_file_link').attr('href','/Media/_documents/_invoices/'+file.name);
			$('#invoice_file_link').attr('target','_blank');
      var docObj = {};
      docObj.values = {},
      docObj._id = $('#invoices_form #_id').val(),
      docObj.url = site_url+'invoices',
      docObj.collection = 'invoices',
      docObj.mongoid = 1;
      docObj.values.invoice_filename = file.name;
      var results = saveEntry(docObj);
      if(results.err == null){
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
});

function invoices_select(invoiceID){
  updateForm(invoiceID,'invoices',['mongoid','client_id','invoice_number','invoice_cost','invoice_filename','invoice_description']);
  if(invoiceID != ''){
    disableElement('clients_select', true);
    disableElement('description', false);
    $("#file_upload").uploadify("disable",false);
    reloadFormElement('status-list', 'invoices', invoiceID);
  } else {
    disableElement('clients_select', false);
    disableElement('description', true);
    $("#file_upload").uploadify("disable",true);
    reloadFormElement('status-list', 'invoices');
  }
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
  reloadFormElement('status-list', 'invoices');
  disableElement('clients_select', false);
  disableElement('description', true);
  $("#file_upload").uploadify("disable",true);
  $('#invoice_file_link').html('Not Available');
  $('#invoice_file_link').attr('href','#');
  $('#invoice_file_link').attr('target','');
  $('#status-desc').html('<p align="center">Nothing to show</p>');
  if(ajax){
    reloadFormElement('invoices_select_container','invoices');
    $('#invoices_select').change(function(){
      invoices_select($(this).val());
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
      } else if(fields[i] == 'invoice_filename'){
        if(formValues[fields[i]] != ''){
          $('#invoice_file_link').html(formValues[fields[i]]);
          $('#invoice_file_link').attr('href','/Media/_documents/_invoices/'+formValues[fields[i]]);
          $('#invoice_file_link').attr('target','_blank');
        } else {
          $('#invoice_file_link').html('Not Available');
          $('#invoice_file_link').attr('href','#');
          $('#invoice_file_link').attr('target','');
        }
      } else {
        $('#'+collection+'_form #'+fields[i]).val(formValues[fields[i]]);
      }
    }
  } else {
    $('#'+collection+'_form')[0].reset();
    $('#'+collection+'_form #_id').val('');
    $('#'+collection+'_form #client_id').val('');
    $('#invoice_file_link').html('Not Available');
    $('#invoice_file_link').attr('href','#');
    $('#invoice_file_link').attr('target','');
  }
}

/**
 * Removes an status event from the database
 */
function removeEvent(event){
  var docObj = {};
  docObj.url = 'invoices',
  docObj.collection = 'invoices',
  docObj.set = 'invoice_history',
  docObj.values = event;
  docObj._id = $('#invoices_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('status-list', 'invoices', $('#invoices_select').val());
}

/**
 * Remove invoice file from media 
 */
function destroyInvoiceFile(_id){
  var result = $.ajax({
    type: "POST",
    url: site_url+"invoices",
    async: false,
    data: {_id: _id, _ajaxFunc: "removeInvoiceFile"}
  });
  if(result.responseText != 'pass'){
    popUpMsg(result.responseText);  
  } else {
    $('#invoice_file_link').html('Not Available');
    $('#invoice_file_link').attr('href','#');
    $('#invoice_file_link').attr('target','');
    popUpMsg('Invoice file successfully deleted.');
  }
}