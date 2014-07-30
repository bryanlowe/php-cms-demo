$(document).ready(function(){
	$('#datepicker').datepicker();
  	$('#submitBtn').click(function(){
    	saveWorkHours();
  	});
  	$('#resetBtn').click(function(){
  		$('#work_id').val('');
    	$('#datepicker').val('');
    	$('#hours').prop('selectedIndex',0);
    	$('#work_description').val('');
  	});
    $('#addBtn').click(function(){
      saveProjectAssignment();
    });
  	$('.project_link').click(function(){
      statusApp.showPleaseWait();
  		var projectID = $(this).attr('id').split('project_')[1];
  		$('#project_id').val(projectID);
  		$('#project_hours_control').show();	
      $('#project_assignment_control').show();
      $('.curr-title').html($(this).html());
      reloadFormElement('hour-list','projects', $('#project_id').val());
      reloadFormElement('writer-list', 'projects', $('#project_id').val());
      statusApp.hidePleaseWait();
	  });
	$('#projectTbl').tablesorter();
	$('#project_hours_control').hide();
  $('#project_assignment_control').hide();
});

/**
 * Saves the project hours to the project
 */
function saveWorkHours(){
  if($('#datepicker').val() == ''){
    popUpMsg('You need to pick a date!');
    return false;
  } else if($('#hours').val() == ''){
    popUpMsg('You need to select your amount of hours!');
    return false;
  } else if($('#work_description').val() == ''){
    popUpMsg('You need to provide a description of work!');
    return false;
  } else if($('#project_id').val() == ''){
    popUpMsg('You need to click on a project!');
    return false;
  }
  var docObj = {};
  docObj.url = 'projects',
  docObj.collection = 'projects',
  docObj.set = 'work_hours',
  docObj.values = {};
  docObj.values.hours = $('#hours').val();
  docObj.values.date = $('#datepicker').val();
  docObj.values.description = $('#work_description').val();
  docObj.values.work_id = $('#work_id').val();
  docObj._id = $('#project_id').val();
  addSetToDoc(docObj);
  $('#resetBtn').click();
  reloadFormElement('hour-list','projects', $('#project_id').val());
}

/**
 * Assign Writer to project
 */
function saveProjectAssignment(){
  if($('#writers_select').val() != ''){
    var docObj = {};
    docObj.url = 'projects',
    docObj.collection = 'projects',
    docObj.set = 'assigned_writers',
    docObj.values = $('#writers_select').val();
    docObj._id = $('#project_id').val();
    docObj.mongoid = 1;
    addSetToDoc(docObj);
    reloadFormElement('writer-list', 'projects', $('#project_id').val());
  }
}

/**
 * Removes writer from project
 */
function removeWriter(writer_id){
  var docObj = {};
  docObj.url = 'projects',
  docObj.collection = 'projects',
  docObj.set = 'assigned_writers',
  docObj.values = writer_id;
  docObj._id = $('#project_id').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('writer-list', 'projects', $('#project_id').val());
}

/**
 * Removes an hour entry from the project
 */
function removeHourEntry(work_id){
  var docObj = {};
  docObj.url = 'projects',
  docObj.collection = 'projects',
  docObj.set = 'work_hours',
  docObj.values = {};
  docObj.values.work_id = work_id;
  docObj._id = $('#project_id').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  reloadFormElement('hour-list', 'projects', $('#project_id').val());
}