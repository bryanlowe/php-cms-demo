$(document).ready(function(){
	$('#clients_select').change(function(){
	    if($(this).val() != ""){
	      	reloadFormElement('project_entries', 'preview-projects', $(this).val());
	      	$('.toggleDesc').click(function(){
				var projectID = $(this).attr('id').split('project_')[1];
				$('#projectDesc').html($('#project_'+projectID+'_desc').html());
			});
	    } else {
	      	reloadFormElement('project_entries', 'preview-projects');
	    }
	});	
	$("#projectTbl").tablesorter();
});