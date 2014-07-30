$(document).ready(function(){
	$('#submitBtn').click(function(){
        saveAccount();
    });
});

/**
 * Validates the form and creates a document from the form before passing it to the save feature
 *
 * @param collection - mongo collection
 * @param mongoid - flags whether a mongo id object was used as an id number
 */
function saveAccount(){
  if(validateForm('writers_form') != false){
    var docObj = createDocFromForm('writers_form');
    docObj._id = $('#writers_form #_id').val();
    docObj.url = site_url+'account';
    docObj.collection = 'writers';
    docObj.mongoid = true;
    var results = saveEntry(docObj);
    if(results.err == null){
      popUpMsg("Save was successful!");
      return true;
    } else {
      popUpMsg(results.err);
      return false;
    }
  }
  return false;
}