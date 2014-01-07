/**
 * Processes the login form. If successful, the site is redirected to the homepage, otherwise returns error
 */
function processLogin(){
  if($('#login_username').val() == ''){
    popUpMsg("User name must be filled.");
    return false;
  } else if($('#login_password').val() == ''){
    popUpMsg("Password must be filled.");
    return false;
  }

  var values = {};
  values['type'] = $('#login_type').val();
  values['email'] = $('#login_email').val();
  values['password'] = $('#login_password').val();
  var url = site_url+"login";
  if(values['type'] == "ADMIN"){
    url = site_url+"admin/login";
  }

  var result = $.ajax({
    type: "POST",
    url: url,
    async: false,
    data: {values: values, _ajaxFunc: "processLogin"}
  });
    
  success = result.responseText;
  if(success != ''){ 
    $('input').css('border', '');
    if(success == 'error'){
      popUpMsg("User validation as failed.");
      $('input').css('border', '1px solid #ff0000');
      return false;
    } else if(success == 'restricted'){
      popUpMsg("User is not authorized.");
      $('input').css('border', '1px solid #ff0000');
      return false;
    } else if(success == 'pass') {
      if($('#login_type').val() == 'ADMIN'){
        location.replace(site_url+'admin');  
      } else {
        location.replace(site_url);  
      }
    }
  }
}

/**
 * For every input field that is incorrect, a red border is drawn around the field
 */
function displayErrors(errors){ 
  errors = errors.split(',');
  for(var i = 0; i < errors.length; i++){
    $('#'+errors[i]).css('border', '1px solid #ff0000');
  }
}

/**
 * Function that modifies the BLL Settings of the CMS system
 */
function updateBLLSettings(action){
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"admin/settings",
    async: false,
    data: {action: action, _ajaxFunc: "updateBLLSettings"}
  });
  statusApp.hidePleaseWait();
}

/**
 * Function that modifies the BLL Forms of the CMS system
 */
function updateBLLForms(action){
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"admin/settings",
    async: false,
    data: {action: action, _ajaxFunc: "updateBLLForms"}
  });
  statusApp.hidePleaseWait();
}

/**
 * Function updates the user form with client information
 */
function updateUserForm(client_id){
  var result = $.ajax({
      type: "POST",
      dataType: "json",
      url: site_url+"admin/users",
      async: false,
      data: {table: 'clients', primaryKey: client_id, bllAction: "SELECTION", _ajaxFunc: "gatherBLLResource"}
  });

  var formValues = $.parseJSON(result.responseText);
  formValues = formValues[0];
  $('#user_id').val('');
  $('#user_name').val(formValues['client_name']);
  $('#password').val('');
  $('#email').val(formValues['email']);
  $('#user_group_id').val(3);
  $('#status').val(1);
}