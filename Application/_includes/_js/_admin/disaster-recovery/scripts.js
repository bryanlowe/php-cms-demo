$(document).ready(function(){
	$('#backupBtn').click(function(){
		dumpDatabase();
	});
	$('#backupTbl').tablesorter();
});

/**
 * Restores a database based on the backup timestampe
 */
function restoreDatabase(database, timestamp){
	statusApp.showPleaseWait();
  	var results = $.ajax({
	    type: "POST",
	    url: site_url+'disaster-recovery',
	    async: false,
	    data: {database: database, timestamp: timestamp, _ajaxFunc: "restoreDatabase"}
	});
  	statusApp.hidePleaseWait();
  	results = $.parseJSON(results.responseText);
  	popUpMsg(results.msg);
}

/**
 * Creates a database dump
 */
function dumpDatabase(){
	statusApp.showPleaseWait();
  	var results = $.ajax({
	    type: "POST",
	    url: site_url+'disaster-recovery',
	    async: false,
	    data: {database: 'dashboard', _ajaxFunc: "dumpDatabase"}
	});
  	reloadFormElement('backup_entries', 'disaster-recovery');
  	statusApp.hidePleaseWait();
  	results = $.parseJSON(results.responseText);
  	popUpMsg(results.msg);
}