$(document).ready(function(){
  $('#create_project').hide();
  $('#submitBtn').click(function(){
    if($('#project_title').val() != ""
    && $('#order_id').val() != ""){
      createProject();
    }
  });
  $('#project_title').prop('disabled', true);
  $('#submitBtn').prop('disabled', true);
});

/**
 * Updates the order records and shows order information
 */
function showOrderDetails(orderID, read){
  $('#order-details h2.no-entries').remove();
  $('#order-details').html($('#order-details-'+orderID).html());
  if(!read){
    $('#order-link-'+orderID).attr('href', "javascript:showOrderDetails('"+orderID+"', 1);");
    $('#order-entry-'+orderID+' span.badge').replaceWith('<button class="close" type="button" onclick="deletePost(\''+orderID+'\');">×</button>');
    var orderHTML = '<span id="order-entry-'+orderID+'">'+$('#order-entry-'+orderID).html()+'</span>';
    $('#order-entry-'+orderID).remove();
    $('#order-past').append(orderHTML);
    $('#order-past h2.no-entries').remove();
    if($('#order-recent').is(':empty')){
      $('#order-recent').append('<h2 class="no-entries" align="center">No orders to show</h2>');
    }
    $.ajax({
      type: "POST",
      url: site_url+"orders",
      async: false,
      data: {_id: orderID, _ajaxFunc: "markAsRead"}
    });
  }
  $('#order_id').val(orderID);
  $('#create_project').show();
  $('#project_title').prop('disabled', false);
  $('#submitBtn').prop('disabled', false);
}

/**
 * Creates a project from the order
 */
function createProject(){
  statusApp.showPleaseWait();
  var docObj = {};
  docObj.order_id = $('#order_id').val();
  docObj.project_title = $('#project_title').val();
  var result = $.ajax({
    type: "POST",
    url: site_url+"orders",
    async: false,
    data: {doc: docObj, _ajaxFunc: "createProject"}
  });
  statusApp.hidePleaseWait();
  result = result.responseText;
  if(result.err == null){
    deletePost($('#order_id').val());
    $('#create_project').hide();
    $('#order_id').val('');
    $('#project_title').val('');
    $('#project_title').prop('disabled', true);
    $('#submitBtn').prop('disabled', true);
    $('#order-details').html('')
    popUpMsg("Project has been created!");
    return true;
  } else {
    popUpMsg(results.err);
    return false;
  }
}

/**
 * Deletes a post from the database
 */
function deletePost(postID){
  $('#order-entry-'+postID).remove();
  if($('#order-past').is(':empty')){
    $('#order-past').append('<h2 class="no-entries" align="center">No orders to show</h2>');
  }
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"orders",
    async: false,
    data: {_id: postID, _ajaxFunc: "deletePost"}
  });
  statusApp.hidePleaseWait();
}