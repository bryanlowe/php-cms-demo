var clientAttachments = [];
var uploadErrors = [];

$(document).ready(function(){
	$('#timestamp').prop('disabled',true);
	$('#token').prop('disabled',true);
	$('#client_id').prop('disabled',true);
	$("#description_container").addClass('col-xs-12');
	$("#description").prop('rows', 15);
	$('#submitBtn').click(function(){
		saveOrder();
	});
	if($('#project_tags_1').length == 0){
		$('#project_tags_container').hide();
	}
	$('#uploadBtn').click(function(){
		$('#file_upload').uploadifive('upload');
	});
	
	$('#file_upload').uploadifive({
		'formData'     : {
			'timestamp' : $('#timestamp').val(),
			'token'     : $('#token').val(),
			'client_id': $('#client_id').val()
		},
		'buttonText': 'UPLOAD ATTACHMENTS',
		'removeCompleted' : true,
    	'fileType' : ["application\/msword","application\/pdf"],
    	'width': 250,
		'uploadScript' : site_url+'Utilities/uploadifive/upload-client-files.php',
		'onUploadFile' : function(file) {
            createFileList(file.name);
        },
        'onError' : function(errorType, file) {
        	if(file != null){
        		removeFromFileList(file.name);
            	uploadErrors.push('The file ' + file.name + ' could not be uploaded: ' + errorType);
        	} else {
        		uploadErrors.push('An error has occured: ' + errorType);
        	}
        },
        'onQueueComplete' : function(queueData) {
            sendUploadNotification();
            clientAttachments = [];
            uploadErrors = [];
        } 
	});
});

/**
 * Saves the order form
 */
function saveOrder(){
	if(validateForm('place_order_form') != false){
		statusApp.showPleaseWait();
	    var docObj = createDocFromForm('place_order_form');
	    var results = $.ajax({
		    type: "POST",
		    url: site_url+'orders',
		    async: false,
		    data: {doc: docObj, _ajaxFunc: "saveEntry"}
		});
	    results = $.parseJSON(results.responseText);
	  	statusApp.hidePleaseWait();
	    if(results.err == null){
	      popUpMsg("Your order has been placed!");
	      $("#place_order_form")[0].reset();
	      return true;
	    } else {
	      popUpMsg(results.err);
	      return false;
	    }
	}
	return false;
}

/**
 * Creates a file list of files successfully selected
 */
 function createFileList(filename){
	clientAttachments.push(filename);
}

/**
 * Removes a file from the file list based on filename
 */
function removeFromFileList(filename){
	var temp = [];
	for(var i = 0; i < clientAttachments.length; i++){
		if(clientAttachments[i] != filename){
			temp.push(clientAttachments[i]);
		}
	}
	clientAttachments = temp;
}

/**
 * Sends the list of uploaded filenames to orders where an email notification 
 * can be sent out to the admin about new uploaded files
 */
function sendUploadNotification(){
	if(clientAttachments.length > 0){
		statusApp.showPleaseWait();
	    var results = $.ajax({
		    type: "POST",
		    url: site_url+'orders',
		    async: false,
		    data: {filenames: clientAttachments, _ajaxFunc: "sendUploadNotification"}
		});
	  	statusApp.hidePleaseWait();
      	var notification = 'The following files have been uploaded:<br />';
      	notification += clientAttachments.join('<br />');
      	if(uploadErrors.length > 0){
      		notification += '<br /><br />';
      		notification += uploadErrors.join('<br />');
      	}
      	popUpMsg(notification);
	} else if(uploadErrors.length > 0){
		var notification = uploadErrors.join('<br />');
		popUpMsg(notification);
	}
}