  /**
   * Saves the form to the database through ajax
   *
   * @param string formType
   */
  function saveEntry(formType){
    statusApp.showPleaseWait();
    var values = {},
        form = formType,
        action = "SAVE",
        priKey = $('form#'+formType.toLowerCase()+'_form .primaryKey').val();
    $.each($('form#'+formType.toLowerCase()+'_form').serializeArray(), function(i, field) {
      if(field.type == 'radio' || field.type == 'checkbox'){
        if(field.checked){
          values[field.name] = field.value;
        }
      } else {
        values[field.name] = field.value;
      }      
      $('form#'+formType.toLowerCase()+'_form #'+field.name+'_container').removeClass('has-error');
    });

    if(form == "invoice_status"){
      form = "InvoiceStatus";
    } else if(form == "invoice_files"){
      form = "InvoiceFiles";
    } else if(form == "project_status"){
      form = "ProjectStatus";
    }


    var result = $.ajax({
      type: "POST",
      url: site_url+"admin/settings",
      async: false,
      data: {form: form, action: action, priKey: priKey, values: values, _ajaxFunc: "processBLLForm"}
    });
      
    statusApp.hidePleaseWait();
    success = result.responseText.split('@');
    if(success.length > 0){ 
      if(success[0] == 'error'){
        displayErrors(success[1], formType);
        return false;
      } else if(success[0] == 'duplicate'){
        popUpMsg("This entry already exists");
        return false;
      } else if(success[0] == 'pass') {
        popUpMsg("Save Success");
        return true;
      }
    } 
  }
 
  /**
   * For every input field that is incorrect, a red border is drawn around the field
   */
  function displayErrors(errors, formType){ 
    errors = errors.split(',');
    for(var i = 0; i < errors.length; i++){
      $('form#'+formType.toLowerCase()+'_form #'+errors[i]+'_container').addClass('has-error');
    }
  }

  /**
   * Deletes the entry from the database through ajax
   *
   * @param string formType
   */
  function deleteEntry(formType){
    statusApp.showPleaseWait();
    var form = formType,
        action = "DELETE",
        priKey = $('form#'+formType.toLowerCase()+'_form .primaryKey').val();

    if(form == "invoice_status"){
      form = "InvoiceStatus";
    } else  if(form == "invoice_files"){
      form = "InvoiceFiles";
    } else if(form == "project_status"){
      form = "ProjectStatus";
    }

    var result = $.ajax({
      type: "POST",
      url: site_url+"admin/settings",
      async: false,
      data: {form: form, action: action, priKey: priKey, _ajaxFunc: "processBLLForm"}
    });
    statusApp.hidePleaseWait();
    popUpMsg(result.responseText);  
  }

  /**
   * Updates the primary key to the new given value
   *
   * @param int formID
   * @param int priKeyVal
   */
  function updatePrimaryKey(formID, table, firstValue, secondValue){
    var result = $.ajax({
      type: "POST",
      url: site_url+"admin/settings",
      async: false,
      data: {table: table, firstValue: firstValue, secondValue: secondValue, _ajaxFunc: "getBLLPrimaryKey"}
    });
    if(result.responseText > 0){
      $('form#'+formID+' .primaryKey').val(result.responseText);
      $('form#'+formID+' input[name="matchSuccess"]').removeClass("disabled");
      $('form#'+formID+' input[name="matchFailure"]').addClass("disabled");
    } else {
      $('form#'+formID+' .primaryKey').val("");
      $('form#'+formID+' input[name="matchSuccess"]').addClass("disabled");
      $('form#'+formID+' input[name="matchFailure"]').removeClass("disabled");
    }    
  }

  /**
   * Update fields by select option name
   *
   * @param selectID 
   * @param textID
   */
  function updateTextBySelect(selectID, textID){
    if($(selectID+' option:selected').text().indexOf('Please select') == -1){
      $(textID).val($(selectID+' option:selected').text());  
    } else {
      $(textID).val('');
    }   
  }

  /**
   * Refreshes the options of select items through the use of ajax
   *
   * @param selectID
   * @param bllType
   * @param ajaxURL
   * @param bllNameLabel
   * @param bllValueLabel
   */
  function refreshBLLSelectOptions(selectID, table, ajaxURL, bllNameLabel, bllValueLabel, order){
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: ajaxURL,
        async: false,
        data: {table: table, primaryKey: null, order: order, bllAction: "COLLECTION", _ajaxFunc: "gatherBLLResource"}
    });

    var options = $(selectID).prop("options");
    var optJSON = $.parseJSON(result.responseText);
    $.each(optJSON, function(i, opt) {
        options[options.length] = new Option(opt[bllNameLabel], opt[bllValueLabel]);
    });
  }

  /**
   * Refreshes the options of select items through the use of ajax
   *
   * @param selectID
   * @param bllType
   * @param ajaxURL
   * @param bllNameLabel
   * @param bllValueLabel
   */
  function selectAllowedBLLResources(selectID, table, ajaxURL, bllNameLabel, bllValueLabel, order){
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: ajaxURL,
        async: false,
        data: {table: table, order: order, _ajaxFunc: "gatherAllowedResource"}
    });

    var options = $(selectID).prop("options");
    var optJSON = $.parseJSON(result.responseText);
    $.each(optJSON, function(i, opt) {
        options[options.length] = new Option(opt[bllNameLabel], opt[bllValueLabel]);
    });
  }

  /**
   * Update form fields by database entry
   *
   * @param formID 
   * @param bllType
   */
  function updateBLLFormFields(formID, table, ajaxURL){
    var primaryKey = ($("form#"+formID+" .primaryKey").val() != "") ? $("form#"+formID+" .primaryKey").val() : null;
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: ajaxURL,
        async: false,
        data: {table: table, primaryKey: primaryKey, bllAction: "SELECTION", _ajaxFunc: "gatherBLLResource"}
    });

    var formValues = $.parseJSON(result.responseText);
    formValues = formValues[0];
    $.each($('form#'+formID).serializeArray(), function(i, field) {
      var value = (typeof(formValues[field.name]) != "undefined" ? formValues[field.name] : "");
      $('form#'+formID+' #'+field.name).val(value);    
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
      $('form#invoice_status_form #invoice_status_id').val(statusFormValues['invoice_status_id']);
      $('form#invoice_status_form #invoice_id').val(statusFormValues['invoice_id']);
      $('form#invoice_status_form #description').val(statusFormValues['description']);
      $('form#invoice_status_form #invoice_status_date').val(statusFormValues['invoice_status_date']);
      $('form#invoice_status_form input[name="saveBtn"]').removeAttr('disabled');
      $('form#invoice_status_form input[name="saveBtn"]').removeClass('disabled');
    } else {
      $('form#invoice_status_form #invoice_status_id').val('');
      if(invoiceID == 0){
        $('form#invoice_status_form #invoice_id').val('');
        $('form#invoice_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
        $('form#invoice_status_form input[name="saveBtn"]').addClass('disabled');
      } else {
        $('form#invoice_status_form #invoice_id').val(invoiceID);
        $('form#invoice_status_form input[name="saveBtn"]').removeAttr('disabled');
        $('form#invoice_status_form input[name="saveBtn"]').removeClass('disabled');
      }
      $('form#invoice_status_form #description').val('');
      $('form#invoice_status_form #invoice_status_date').val('');
    }
  }

  /**
   * Update form fields by database entry
   *
   * @param invoiceID 
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
      $('form#project_status_form #project_status_id').val(statusFormValues['project_status_id']);
      $('form#project_status_form #project_id').val(statusFormValues['project_id']);
      $('form#project_status_form #status').val(statusFormValues['status']);
      $('form#project_status_form #description').val(statusFormValues['description']);
      $('form#project_status_form #project_status_date').val(statusFormValues['project_status_date']);
      $('form#project_status_form input[name="saveBtn"]').removeAttr('disabled');
      $('form#project_status_form input[name="saveBtn"]').removeClass('disabled');
    } else {
      $('form#project_status_form #project_status_id').val('');
      if(projectID == 0){
        $('form#project_status_form #project_id').val('');
        $('form#project_status_form input[name="saveBtn"]').attr('disabled', 'disabled');
        $('form#project_status_form input[name="saveBtn"]').addClass('disabled');
      } else {
        $('form#project_status_form #project_id').val(invoiceID);
        $('form#project_status_form input[name="saveBtn"]').removeAttr('disabled');
        $('form#project_status_form input[name="saveBtn"]').removeClass('disabled');
      }
      $('form#project_status_form #status').val('');
      $('form#project_status_form #description').val('');
      $('form#project_status_form #project_status_date').val('');
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
      $('form#invoice_files_form #invoice_file_id').val(fileFormValues['invoice_file_id']);
      $('form#invoice_files_form #invoice_id').val(fileFormValues['invoice_id']);
      $('form#invoice_files_form #invoice_filename').val(fileFormValues['invoice_filename']);
      $('#invoice_file_link').html(fileFormValues['invoice_filename']);
      $('#invoice_file_link').attr('href','/Media/_documents/_invoices/'+fileFormValues['invoice_filename']);
      $('#invoice_file_link').attr('target','_blank');
      $('#file_upload').uploadify('disable', false);
      $('.deleteFile').removeAttr('disabled');
      $('.deleteFile').removeClass('disabled');
    } else {
      $('form#invoice_files_form #invoice_file_id').val('');
      if(invoiceID == 0){
        $('form#invoice_files_form #invoice_id').val('');
        $('#file_upload').uploadify('disable', true);
        $('.deleteFile').attr('disabled', 'disabled');
        $('.deleteFile').addClass('disabled');
      } else {
        $('form#invoice_files_form #invoice_id').val(invoiceID);
        $('#file_upload').uploadify('disable', false);
        $('.deleteFile').removeAttr('disabled');
        $('.deleteFile').removeClass('disabled');
      }
      $('form#invoice_files_form #invoice_filename').val('');
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
    destroyInvoiceFile($('form#invoice_files_form #invoice_filename').val());
    $('form#invoice_files_form #invoice_filename').val('');
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

  /**
   * Updates the feedback records and shows feedback information
   */
  function showFeedbackDetails(feedbackID, read){
    $('#feedback-details h2.no-entries').remove();
    $('#feedback-details').html($('#fb-details-'+feedbackID).html());
    if(!read){
      $('#fb-link-'+feedbackID).attr('href', 'javascript:showFeedbackDetails('+feedbackID+', 1);');
      $('#feedback-past').append($('#fb-entry-'+feedbackID).html());
      $('#fb-entry-'+feedbackID).remove();
      $('#feedback-past h2.no-entries').remove();
      if($('#feedback-recent').is(':empty')){
        $('#feedback-recent').append('<h2 class="no-entries" align="center">No feedback to show</h2>');
      }
      $.ajax({
        type: "POST",
        url: site_url+"admin/feedback",
        async: false,
        data: {feedbackID: feedbackID, _ajaxFunc: "markAsRead"}
      });
    }
  }

  /**
   * Updates the order records and shows order information
   */
  function showOrderDetails(orderID, read){
    $('#order-details h2.no-entries').remove();
    $('#order-details').html($('#order-details-'+orderID).html());
    if(!read){
      $('#order-link-'+orderID).attr('href', 'javascript:showOrderDetails('+orderID+', 1);');
      $('#order-past').append($('#order-entry-'+orderID).html());
      $('#order-entry-'+orderID).remove();
      $('#order-past h2.no-entries').remove();
      if($('#order-recent').is(':empty')){
        $('#order-recent').append('<h2 class="no-entries" align="center">No orders to show</h2>');
      }
      $.ajax({
        type: "POST",
        url: site_url+"admin/orders",
        async: false,
        data: {orderID: orderID, _ajaxFunc: "markAsRead"}
      });
    }
  }