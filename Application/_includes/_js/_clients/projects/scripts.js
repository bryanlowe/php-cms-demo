$(document).ready(function(){
	$('.toggleDesc').click(function(){
		var projectID = $(this).attr('id').split('project_')[1];
		$('#projectStatus').html($('#project_'+projectID+'_details').html());
		$('#projectDesc').html($('#project_'+projectID+'_desc').html());
	});
	$("#projectTbl").tablesorter();
});