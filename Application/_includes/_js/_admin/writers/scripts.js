$(document).ready(function(){
	$('#writer_rate_container').css('padding-left', '42px');
    $('#email_container').addClass('col-lg-offset-2');
    $('#writer_rate_container').addClass('col-lg-offset-2');
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
});

function writers_select(){
	updateForm($('#writers_select').val(),'writers',['mongoid','writer_name','email','writer_type','writer_rate']);
	if($('#writers_select').val() != ''){
		$('#opt_in').prop('disabled', false);
		reloadFormElement('opt-in-list', 'writers', $('#writers_select').val());
	} else {
		$('#opt_in').prop('disabled', true);
		reloadFormElement('opt-in-list', 'writers');
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
  	reloadFormElement('opt-in-list', 'writers');
  	if(ajax){
  		reloadFormElement('writers_select_container','writers');
		$('#writers_select').change(function(){
			writers_select();
		});
  	}
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