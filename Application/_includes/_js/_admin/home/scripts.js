$(document).ready(function(){
	var unreadFeedbackCount = Number(getCountFromTable('feedback','read_status = "0"',site_url));
	var unreadOrderCount = Number(getCountFromTable('orders','read_status = "0"',site_url));
	if(unreadFeedbackCount > 0){
		$('#feedback-container').removeClass('panel-info');
		$('#feedback-container').addClass('panel-success');
		$('#feedback-title').html('<p class="announcement-heading">'+unreadFeedbackCount+'</p><p class="announcement-text">New Feedback!</p>');
	}
	if(unreadOrderCount > 0){
		$('#order-container').removeClass('panel-info');
		$('#order-container').addClass('panel-success');
		$('#order-title').html('<p class="announcement-heading">'+unreadOrderCount+'</p><p class="announcement-text">New Orders!</p>');
	}
});