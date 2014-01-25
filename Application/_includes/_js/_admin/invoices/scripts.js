$(document).ready(function(){
	refreshBLLSelectOptions("#invoices_form select#invoice_id", "invoices", site_url+"admin/invoices", "invoice_number", "invoice_id", "invoice_number ASC");
	refreshBLLSelectOptions("#invoices_form select#client_id", "clients", site_url+"admin/invoices", "company", "client_id", "company ASC");
	$("#invoices_form select#invoice_id").change(function(){
		updateBLLFormFields('invoices_form','invoices',site_url+'admin/invoices'); 
		updateInvoiceStatusForm($(this).val());
		updateInvoiceFileForm($(this).val());
	});
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
		'swf'      : site_url+'Utilities/uploadify/uploadify.swf',
		'uploader' : site_url.replace('https','http')+'/Utilities/uploadify/uploadify.php',
		'onUploadSuccess' : function(file, data, response) {
			$('#invoice_file_link').html(file.name);
			$('#invoice_file_link').attr('href','/Media/_documents/_invoices/'+file.name);
			$('#invoice_file_link').attr('target','_blank');
			$('#invoice_files_form #invoice_filename').val(file.name);
			saveEntry('invoice_files');
    	}
	});
	$('#file_upload-button').attr('style', '');
	$('#file_upload-button').addClass('disabled');
    $('.deleteFile').attr('disabled', 'disabled');
    $('.deleteFile').addClass('disabled');
    $('#invoice_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
    $('#invoice_status_form input[name="saveBtn"]').addClass('disabled');
});

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(){
	refreshBLLSelectOptions("#invoices_form select#invoice_id", "invoices", site_url+"admin/invoices", "invoice_number", "invoice_id", "invoice_number ASC");
	$("#invoices_form")[0].reset();
	$("#invoice_status_form")[0].reset();
  $('#invoice_status_form #invoice_status_id').val('');
  $('#invoice_status_form #invoice_status_date').val('');
	$("#invoice_files_form")[0].reset();
  $('#invoice_files_form #invoice_file_id').val('');
  $('#invoice_files_form #invoice_filename').val('');
	$('#file_upload').uploadify('disable', true);
  $('.deleteFile').attr('disabled', 'disabled');
  $('.deleteFile').addClass('disabled');
  $('#invoice_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
  $('#invoice_status_form input[name="saveBtn"]').addClass('disabled');
  $('#invoice_file_link').html('Not Available');
  $('#invoice_file_link').attr('href','#');
  $('#invoice_file_link').attr('target','');
}

/**
 * Saves the invoice form
 */
function saveInvoice(){
	var results = saveEntry('Invoices');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'invoices');
    		return false;
	  	} else if(results[0] == 'duplicate'){
	    	popUpMsg("This invoice already exists!");
	    	return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Invoice was saved successfully!");
	    	reloadPageElements();
	    	return true;
	  	}
	}
}

/**
 * Saves the invoice status form
 */
function saveStatus(){
	var results = saveEntry('invoice_status');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'invoice_status');
    		return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Invoice status was saved successfully!");
	    	return true;
	  	}
	}
}

/**
 * Delete the invoice form
 */
function deleteInvoice(){
	var result = "";
	$.prompt("<p>Are you sure you want to delete this invoice?</p><p>Deleting this invoice will delete the invoice status and files associated with this invoice.</p>", {
		title: "Are you sure?",
		buttons: { "Yes": true, "No": false },
		submit: function(e,v,m,f){ 
			if(v){
				result = deleteEntry('Invoices');
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
   * @param invoiceID 
   */
  function updateInvoiceStatusForm(invoiceID){
    invoiceID = (invoiceID != "") ? invoiceID : 0;
    var statusResult = $.ajax({
        type: "POST",
        dataType: "json",
        url: '/admin/invoices',
        async: false,
        data: {invoiceID: invoiceID, _ajaxFunc: "getInvoiceStatus"}
    });

    var statusFormValues = $.parseJSON(statusResult.responseText);
    statusFormValues = statusFormValues[0];
    if(typeof(statusFormValues) != "undefined"){
      $('#invoice_status_form #invoice_status_id').val(statusFormValues['invoice_status_id']);
      $('#invoice_status_form #invoice_id').val(statusFormValues['invoice_id']);
      $('#invoice_status_form #description').val(statusFormValues['description']);
      $('#invoice_status_form #invoice_status_date').val(statusFormValues['invoice_status_date']);
      $('#invoice_status_form input[name="saveBtn"]').removeAttr('disabled');
      $('#invoice_status_form input[name="saveBtn"]').removeClass('disabled');
    } else {
      $("#invoice_status_form")[0].reset();
      $('#invoice_status_form #invoice_status_id').val('');
      $('#invoice_status_form #invoice_status_date').val('');
      if(invoiceID == 0){
        $('#invoice_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
        $('#invoice_status_form input[name="saveBtn"]').addClass('disabled');
      } else {
        $('#invoice_status_form #invoice_id').val(invoiceID);
        $('#invoice_status_form input[name="saveBtn"]').removeAttr('disabled');
        $('#invoice_status_form input[name="saveBtn"]').removeClass('disabled');
      }
    }
  }

  /**
   * Update form fields by database entry
   *
   * @param invoiceID 
   */
  function updateInvoiceFileForm(invoiceID){
    invoiceID = (invoiceID != "") ? invoiceID : 0;
    var formResult = $.ajax({
        type: "POST",
        dataType: "json",
        url: '/admin/invoices',
        async: false,
        data: {invoiceID: invoiceID, _ajaxFunc: "getInvoiceFile"}
    });

    var fileFormValues = $.parseJSON(formResult.responseText);
    fileFormValues = fileFormValues[0];
    if(typeof(fileFormValues) != "undefined"){
      $('#invoice_files_form #invoice_file_id').val(fileFormValues['invoice_file_id']);
      $('#invoice_files_form #invoice_id').val(fileFormValues['invoice_id']);
      $('#invoice_files_form #invoice_filename').val(fileFormValues['invoice_filename']);
      $('#invoice_file_link').html(fileFormValues['invoice_filename']);
      $('#invoice_file_link').attr('href','/Media/_documents/_invoices/'+fileFormValues['invoice_filename']);
      $('#invoice_file_link').attr('target','_blank');
      $('#file_upload').uploadify('disable', false);
      $('.deleteFile').removeAttr('disabled');
      $('.deleteFile').removeClass('disabled');
    } else {
      $("#invoice_files_form")[0].reset();
      $('#invoice_files_form #invoice_file_id').val('');
      $('#invoice_files_form #invoice_filename').val('');
      if(invoiceID == 0){
        $('#file_upload').uploadify('disable', true);
        $('.deleteFile').attr('disabled', 'disabled');
        $('.deleteFile').addClass('disabled');
      } else {
        $('#invoice_files_form #invoice_id').val(invoiceID);
        $('#file_upload').uploadify('disable', false);
        $('.deleteFile').removeAttr('disabled');
        $('.deleteFile').removeClass('disabled');
      }
      $('#invoice_file_link').html('Not Available');
      $('#invoice_file_link').attr('href','#');
      $('#invoice_file_link').attr('target','');
    }
  }

  /**
   * Remove invoice file from database and file from media 
   */
  function deleteInvoiceFile(){
    deleteEntry('invoice_files');
    destroyInvoiceFile($('#invoice_files_form #invoice_filename').val());
    $('#invoice_files_form #invoice_filename').val('');
    $('#invoice_file_link').html('Not Available');
    $('#invoice_file_link').attr('href','#');
    $('#invoice_file_link').attr('target','');
  }

  /**
   * Remove invoice file from media 
   */
  function destroyInvoiceFile(filename){
    var result = $.ajax({
      type: "POST",
      url: site_url+"admin/invoices",
      async: false,
      data: {filename: filename, _ajaxFunc: "removeInvoiceFile"}
    });
  }