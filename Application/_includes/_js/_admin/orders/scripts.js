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