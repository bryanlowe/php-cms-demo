/**
 * Updates the order records and shows order information
 */
function showOrderDetails(orderID, read){
  $('#order-details h2.no-entries').remove();
  $('#order-details').html($('#order-details-'+orderID).html());
  if(!read){
    $('#order-link-'+orderID).attr('href', "javascript:showOrderDetails('"+orderID+"', 1);");
    $('#order-past').append($('#order-entry-'+orderID).html());
    $('#order-entry-'+orderID).remove();
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