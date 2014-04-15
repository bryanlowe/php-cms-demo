/**
 * Updates the feedback records and shows feedback information
 */
function showFeedbackDetails(feedbackID, read){
  $('#feedback-details h2.no-entries').remove();
  $('#feedback-details').html($('#fb-details-'+feedbackID).html());
  if(!read){
    $('#fb-link-'+feedbackID).attr('href', "javascript:showFeedbackDetails('"+feedbackID+"', 1);");
    $('#fb-entry-'+feedbackID+' span.badge').replaceWith('<button class="close" type="button" onclick="deletePost(\''+feedbackID+'\');">×</button>');
    var feedbackHTML = '<span id="fb-entry-'+feedbackID+'">'+$('#fb-entry-'+feedbackID).html()+'</span>';
    $('#fb-entry-'+feedbackID).remove();
    $('#feedback-past').append(feedbackHTML);
    $('#feedback-past h2.no-entries').remove();
    if($('#feedback-recent').is(':empty')){
      $('#feedback-recent').append('<h2 class="no-entries" align="center">No feedback to show</h2>');
    }
    $.ajax({
      type: "POST",
      url: site_url+"feedback",
      async: false,
      data: {_id: feedbackID, _ajaxFunc: "markAsRead"}
    });
  }
}

/**
 * Deletes a post from the database
 */
function deletePost(postID){
  $('#fb-entry-'+postID).remove();
  if($('#feedback-past').is(':empty')){
    $('#feedback-past').append('<h2 class="no-entries" align="center">No feedback to show</h2>');
  }
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"feedback",
    async: false,
    data: {_id: postID, _ajaxFunc: "deletePost"}
  });
  statusApp.hidePleaseWait();
}