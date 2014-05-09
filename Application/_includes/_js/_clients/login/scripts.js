$(document).ready(function(){
	$('#login_form').addClass('col-lg-offset-2');
  $('#login_password').keypress(function(event) {
		if(event.which == 13){
			processLogin();
		}
	});
	$('#login_email').keypress(function(event) {
		if(event.which == 13){
			processLogin();
		}
	});
});

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
        location.replace(site_url);  
    }
  }
}