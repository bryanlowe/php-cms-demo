$(document).ready(function(){
	$('#writer_rate_container').css('padding-left', '42px');
    $('#email_container').addClass('col-lg-offset-2');
    $('#writer_rate_container').addClass('col-lg-offset-2');
    $('#pending_date_container').addClass('col-lg-offset-2');
    $('#addOptIn_container').css('padding-top', '5px');
	$('#writers_select').change(function(){
		writers_select();
	});
	$('#submitBtn').click(function(){
		$('#opt_in').prop('disabled', true);
		saveDoc('writers',true);
	});
	$('#resetBtn').click(function(){
		reloadPageElements('writers',false);
	});
	$('#addOptIn').click(function(){
		if($('#opt_in').val() != ''){
			var docObj = {};
			docObj.url = 'writers',
			docObj.collection = 'writers',
			docObj.set = 'opt_in',
			docObj.values = $('#opt_in').val();
			docObj._id = $('#writers_select').val();
			docObj.mongoid = 1;
			addSetToDoc(docObj);
			$('#opt_in').val('');
			reloadFormElement('opt-in-list', 'writers', $('#writers_select').val());
		}
	});
	$('#opt_in').prop('disabled', true);
	$('#pending_rate').prop('disabled', true);
	$('#pending_date').prop('disabled', true);
	$("#pending_date").datepicker({ 
      	firstDay: 1, 
      	//Before Populating the Calendar set the Enabled & Disabled Dates using beforeShowDay(Date) function
      	beforeShowDay: function (date) {
 
            //Get today's date
            var today = new Date();
 
            //Set the time of today's date to 00:00:00 
            today.setHours(0,0,0,0);
 
            //Now return the enabled and disabled dates to datepicker
            return [(date >= today), ''];
      	}
  	});
});

function writers_select(){
	updateForm($('#writers_select').val(),'writers',['mongoid','writer_name','email','writer_type','writer_rate','pending_rate','pending_date']);
	if($('#writers_select').val() != ''){
		$('#opt_in').prop('disabled', false);
		$('#pending_rate').prop('disabled', false);
		$('#pending_date').prop('disabled', false);
		reloadFormElement('opt-in-list', 'writers', $('#writers_select').val());
		reloadFormElement('writer-performance', 'writers', $('#writers_select').val());
	} else {
		$('#opt_in').prop('disabled', true);
		$('#pending_rate').prop('disabled', true);
		$('#pending_date').prop('disabled', true);
		reloadFormElement('opt-in-list', 'writers');
		reloadFormElement('writer-performance', 'writers');
	}
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection, ajax){
  	$('#'+collection+'_form')[0].reset();
  	$('#'+collection+'_form #_id').val('');
  	$('#'+collection+'_select').prop('selectedIndex',0);
  	$('#opt_in').prop('disabled', true);
    $('#pending_rate').prop('disabled', true);
    $('#pending_date').prop('disabled', true);
  	reloadFormElement('opt-in-list', 'writers');
  	if(ajax){
  		reloadFormElement('writers_select_container','writers');
		$('#writers_select').change(function(){
			writers_select();
		});
  	}
}

/**
 * Validates the form and creates a document from the form before passing it to the save feature
 *
 * @param collection - mongo collection
 * @param mongoid - flags whether a mongo id object was used as an id number
 */
function saveDoc(collection, mongoid){
  if(($('#pending_rate').val() != "" && $('#pending_date').val() == "")
  || ($('#pending_rate').val() == "" && $('#pending_date').val() != "")){
  	if($('#pending_rate').val() != "" && $('#pending_date').val() == ""){
  		popUpMsg('If you fill in a pending raise for a writer, you must provide a date the raise goes into effect.');
  		$('#pending_date').focus();
  		return false;
  	} else {
  		popUpMsg('You shouldn\'t fill in a date for a raise to go into effect, unless you filling the new raise amount as well.');
  		$('#pending_rate').focus();
  		return false;
  	}
  }

  if(validateForm(collection+'_form') != false){
    var docObj = createDocFromForm(collection+'_form');
    docObj._id = $('#'+collection+'_form #_id').val();
    docObj.url = site_url+collection;
    docObj.collection = collection;
    docObj.mongoid = mongoid;
    var results = saveEntry(docObj);
    if(results.err === null){
      popUpMsg("Save was successful!");
      reloadPageElements(collection, true); 
      return true;
    } else {
      popUpMsg(results.err);
      return false;
    }
  }
  return false;
}

/**
 * Removes opt-in from the writer from the database
 */
function removeOptIn(opt_in_id){
  var docObj = {};
  docObj.url = 'writers',
  docObj.collection = 'writers',
  docObj.set = 'opt_in',
  docObj.values = opt_in_id;
  docObj._id = $('#writers_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('opt-in-list', 'writers', $('#writers_select').val());
}