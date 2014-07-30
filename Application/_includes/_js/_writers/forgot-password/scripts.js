$(document).ready(function(){
  $('#forgot-password_form').addClass('col-lg-offset-2');
  $('#submitBtn').click(function() {
      processForgottenPassword();
  });
});

/**
 * Processes the forgotten password form. If successful, the new password will be emailed to the user, otherwise returns error
 */
function processForgottenPassword(){
  if($('#email').val() == ''){
    popUpMsg("Email must be filled.");
    return false;
  }
  statusApp.showPleaseWait();
  var result = $.ajax({
    type: "POST",
    url: site_url+"forgot-password",
    async: false,
    data: {email: $('#email').val(), _ajaxFunc: "processForgotPassword"}
  });
  statusApp.hidePleaseWait();  
  results = result.responseText;
  if(results == 'pass'){
    popUpMsg('Your password has been reset and sent to your email. Once you get it, please try again <a href="/writers/login">here</a>.'); 
    return true;
  } else {
    popUpMsg(results);
    return false;
  }
}