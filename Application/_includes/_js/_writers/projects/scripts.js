$(document).ready(function(){
	$('.toggleDesc').click(function(){
		var projectID = $(this).attr('id').split('project_')[1];
		$('#projectDesc').html($('#project_'+projectID+'_desc').html());
	});
	$("#projectTbl").tablesorter();
});