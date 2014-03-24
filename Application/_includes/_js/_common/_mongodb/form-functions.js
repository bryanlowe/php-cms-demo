/**
 * Saves the form to the database through ajax
 *
 * @param obj docObj
 */
function saveEntry(docObj){
  statusApp.showPleaseWait();

  var result = $.ajax({
    type: "POST",
    url: docObj.url,
    async: false,
    data: {doc: docObj, _ajaxFunc: "saveEntry"}
  });
    
  statusApp.hidePleaseWait();
  return result.responseText; 
}

/**
 * Adds a unique value to an existing set of values in a document
 *
 * @param url
 * @param set
 */
function addSetToDoc(docObj){
  statusApp.showPleaseWait();
  var result = $.ajax({
    type: "POST",
    url: docObj.url,
    async: false,
    data: {doc: docObj, _ajaxFunc: "addSetToEntry"}
  });
  statusApp.hidePleaseWait();
  return result.responseText; 
}

/**
 * Validates whether required fields have been filled out.
 * 
 * @param string formID
 */
function validateForm(formID){
  var errorCount = 0;
  $('form#'+formID+' input[required="1"]').each(function(){
    if($.trim($(this).val()).length == 0){
      $('form#'+formID+' #'+$(this).attr('name')+'_container').addClass("has-error");
      errorCount++;
    } else {
      $('form#'+formID+' #'+$(this).attr('name')+'_container').removeClass("has-error");
    }
  });
  $('form#'+formID+' textarea[required="1"]').each(function(){
    if($.trim($(this).val()).length == 0){
      $('form#'+formID+' #'+$(this).attr('name')+'_container').addClass("has-error");
      errorCount++;
    } else {
      $('form#'+formID+' #'+$(this).attr('name')+'_container').removeClass("has-error");
    }
  });
  $('form#'+formID+' select[required="1"]').each(function(){
    if($.trim($(this).val()).length == 0){
      $('form#'+formID+' #'+$(this).attr('name')+'_container').addClass("has-error");
      errorCount++;
    } else {
      $('form#'+formID+' #'+$(this).attr('name')+'_container').removeClass("has-error");
    }
  });
  return (errorCount == 0) ? true : false;
}

/**
 * Creates a document object from the form entries.
 * 
 * @param string formID
 */
function createDocFromForm(formID){
  var docObj = {},
      values = {};
  $.each($('form#'+formID).serializeArray(), function(i, field) {
    if(field.type == 'radio' || field.type == 'checkbox'){
      if(field.checked){
        values[field.name] = field.value;
      }
    } else if(field.name != '_id') {
      values[field.name] = field.value;
    }      
    $('form#'+formID+' #'+field.name+'_container').removeClass('has-error');
  });
  docObj['values'] = values;
  return docObj;
}

/**
 * Deletes the entry from the database through ajax
 *
 * @param obj docObj
 */
function deleteEntry(docObj){
  statusApp.showPleaseWait();

  var result = $.ajax({
    type: "POST",
    url: docObj.url,
    async: false,
    data: {doc: docObj, _ajaxFunc: "deleteEntry"}
  });
    
  statusApp.hidePleaseWait();
  return result.responseText;  
}

/**
 * Reloads page elements to reflect changes in the database
 */
function reloadPageElements(collection){
  $('#'+collection+'_form')[0].reset();
  $('#'+collection+'_form #_id').val('');
  $('#'+collection+'_select').prop('selectedIndex',0);
}

/**
 * Validates the form and creates a document from the form before passing it to the save feature
 *
 * @param collection - mongo collection
 * @param mongoid - flags whether a mongo id object was used as an id number
 */
function saveDoc(collection, mongoid){
  if(validateForm(collection+'_form') != false){
    var docObj = createDocFromForm(collection+'_form');
    docObj._id = $('#'+collection+'_form #_id').val();
    docObj.url = site_url+collection;
    docObj.collection = collection;
    docObj.mongoid = mongoid;
    var results = saveEntry(docObj);
    if(results.err == null){
      popUpMsg("Save was successful!");
      reloadPageElements(collection, true); 
      return true;
    } else {
      popUpMsg(results.msg);
      return false;
    }
  }
  return false;
}

/**
 * Creates a deletion prompt that asks the user if they are sure they want to delete the entry, then 
 * creates a document from the form before sending it to the delete feature
 *
 * @param collection - mongo collection
 * @param mongoid - flags whether a mongo id object was used as an id number
 */
function deleteDoc(collection, mongoid){
  var deleteResult = false;
  if($('#'+collection+'_form #_id').val() != ""){
    var result = "";
    $.prompt("<p>Are you sure you want to delete this entry?</p>", {
      title: "Are you sure?",
      buttons: { "Yes": true, "No": false },
      submit: function(e,v,m,f){ 
        if(v){
          var docObj = createDocFromForm(collection+'_form');
          docObj._id = $('#'+collection+'_form #_id').val();
          docObj.url = site_url+collection;
          docObj.collection = collection;
          docObj.mongoid = mongoid;
          var results = deleteEntry(docObj);
          if(results.err == null){
            reloadPageElements(collection, true); 
            deleteResult = true;
          }
        }
        $.prompt.close();
      }
    });
  } else {
    popUpMsg('You cannot delete an entry that has not been saved!');
  }
  return deleteResult;
}

/**
 * Function updates the form with database information
 *
 * @param _id - mongo id number
 * @param collection - mongo collection
 * @param fields - mongo key attributes to be collected
 */
function updateForm(_id, collection, fields){
  if(_id != ''){
    var mongoid = false;
    if($.inArray('mongoid',fields) > -1){mongoid = true;}
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: site_url+collection,
        async: false,
        data: {_id: _id, collection: collection, mongoid: mongoid, _ajaxFunc: "getEntry"}
    });
    var formValues = $.parseJSON(result.responseText);
    $('#'+collection+'_form')[0].reset();
    for(var i = 0; i < fields.length; i++){
      if(fields[i] == 'mongoid'){
        $('#'+collection+'_form #_id').val(formValues._id['$id']);
      } else {
        $('#'+collection+'_form #'+fields[i]).val(formValues[fields[i]]);
      }
    }
  } else {
    $('#'+collection+'_form')[0].reset();
    $('#'+collection+'_form #_id').val('');
  }
}

/**
 * Reloads the element by Dom ID and ajax
 *
 * @param id - dom id
 * @param url - site url for ajax
 */
function reloadFormElement(dom_id, url, _id){
  if(dom_id != ''){
    if(typeof(_id) == 'undefined'){_id = 0;}
    var result = $.ajax({
        type: "POST",
        dataType: "json",
        url: site_url+url,
        async: false,
        data: {dom_id: dom_id, _id: _id, _ajaxFunc: "renderPageElement"}
    });
    $('#'+dom_id).html(result.responseText);
  }
}