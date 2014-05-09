$(document).ready(function(){
  $('#zip_container').css('padding-left', '30px');
  $('#company_container').addClass('col-lg-offset-1');
  $('#client_name_container').addClass('col-lg-offset-2');
  $('#email_container').addClass('col-lg-offset-1');
  $('#phone_number_container').addClass('col-lg-offset-2');
  $('#password_container').addClass('col-lg-offset-1');
  $('#confirm_password_container').addClass('col-lg-offset-2');
  $('#address_container').addClass('col-lg-offset-1');
  $('#city_container').addClass('col-lg-offset-2');
  $('#state_container').addClass('col-lg-offset-1');
  $('#zip_container').addClass('col-lg-offset-2');
  $('<h3>Required Fields:</h3>').insertBefore('#company_container');
  $('<div class="clear"><hr></div><h3>Optional Fields:</h3>').insertBefore('#address_container');
  $('#submitBtn').click(function(){
    processRegistration();
  });
});

/**
 * Processes the Registration form. If successful, the site is redirected to the homepage, otherwise returns error
 */
function processRegistration(){
  if(validateForm('register_form') != false){
    var password = $('#password').val();
    if($('#password').val() != $('#confirm_password').val()){
      popUpMsg("Passwords do not match.");
      return false;
    } else if(password.length < 8){
      popUpMsg("Password must be at least 8 characters long.");
      return false;
    }

    var docObj = createDocFromForm('register_form');
    docObj.url = site_url+'register';
    var results = saveEntry(docObj);
    if(results == 'pass'){
      location.replace(site_url); 
      return true;
    } else {
      popUpMsg(results);
      return false;
    }
  }
  return false;
}