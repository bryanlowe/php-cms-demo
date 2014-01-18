/**
 * Updates the feedback records and shows feedback information
 */
function showFeedbackDetails(feedbackID, read){
  $('#feedback-details h2.no-entries').remove();
  $('#feedback-details').html($('#fb-details-'+feedbackID).html());
  if(!read){
    $('#fb-link-'+feedbackID).attr('href', 'javascript:showFeedbackDetails('+feedbackID+', 1);');
    $('#feedback-past').append($('#fb-entry-'+feedbackID).html());
    $('#fb-entry-'+feedbackID).remove();
    $('#feedback-past h2.no-entries').remove();
    if($('#feedback-recent').is(':empty')){
      $('#feedback-recent').append('<h2 class="no-entries" align="center">No feedback to show</h2>');
    }
    $.ajax({
      type: "POST",
      url: site_url+"admin/feedback",
      async: false,
      data: {feedbackID: feedbackID, _ajaxFunc: "markAsRead"}
    });
  }
}