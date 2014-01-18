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
      url: site_url+"admin",
      async: false,
      data: {form: form, action: action, priKey: priKey, values: values, _ajaxFunc: "processBLLForm"}
    });
      
    statusApp.hidePleaseWait();
    return result.responseText.split('@'); 
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
      url: site_url+"admin",
      async: false,
      data: {form: form, action: action, priKey: priKey, _ajaxFunc: "processBLLForm"}
    });
    statusApp.hidePleaseWait();
    return result.responseText;  
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
      url: site_url+"admin",
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

    var select = $(selectID).prop("options");
    var firstOpt = new Option($(selectID+" option:first").text(),$(selectID+" option:first").val());
    $(selectID).empty();
    select[select.length] = firstOpt;
    var optJSON = $.parseJSON(result.responseText);
    $.each(optJSON, function(i, opt) {
        select[select.length] = new Option(opt[bllNameLabel], opt[bllValueLabel]);
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
    var primaryKey = ($("form#"+formID+" .primaryKey").val() != "") ? $("form#"+formID+" .primaryKey").val() : 0;
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