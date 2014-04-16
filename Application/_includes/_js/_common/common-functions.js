/**
 * If the user is idle for 5 minutes, they are automatically logged out.
 
$(document).idle({
  onIdle: function(){
  	if(window.location.href.indexOf("admin") > -1){
  		if(window.location.href.indexOf("logout") == -1
	  	&& window.location.href.indexOf("login") == -1){
	  		location.replace(site_url+"admin/logout");
	  	}
  	} else {
  		if(window.location.href.indexOf("logout") == -1
	  	&& window.location.href.indexOf("login") == -1){
	  		location.replace(site_url+"logout");
	  	}
  	}
  },
  idle: 300000
});
*/

/**
 * Status bar
 */
var statusApp;
statusApp = statusApp || (function () {
    var pleaseWaitDiv = $('<div class="modal col-lg-4" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="progress-bar" style="width: 100%;"></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();

/**
 * All impromptu properties are stored here.
 */
var popUpProperties = {
	classes: {
				box: '',
				fade: '',
				prompt: '',
				close: '',
				title: 'lead',
				message: '',
				buttons: '',
				button: 'pure-button',
				defaultButton: 'pure-button-primary'
			 }
}

/**
 * Performs pop up messages using impromptu
 */
function popUpMsg(msg){
	$.prompt(msg, popUpProperties);
}

/**
 * Creates a form that allows the user to select the client or webserver used in the CMS
 */
function launchResourceForm(type){
	var formProperties = {
		state0 : {
			title: "Please select a "+type,
			html: $("form#"+type+"_form").html(),
			buttons: {SUBMIT: true, CANCEL: false},
			submit: function(e,v,m,f){ 
				//console.log(f); //comment in for debugging processes
				var status = "",
				stateOpts = null;
				e.preventDefault();
				if(v && f[type+"-list"] != "") {
					if(type == "client"){
						status = lockClient(f[type+"-list"]);
						stateOpts = {
							html: status,
							buttons: {OK: true}
						}
						jQuery.prompt.addState("state1", stateOpts, "state0")
						$.prompt.goToState('state1');
					} else if(type == "webserver"){
						status = updateWebserver(f[type+"-list"]);
						stateOpts = {
							html: status,
							buttons: {OK: true}
						}
						jQuery.prompt.addState("state1", stateOpts, "state0")
						$.prompt.goToState('state1');
					}
				} else if(v && f[type+"-list"] == ""){
					return false;
				} else if(!v){
					$.prompt.close();
				}
			}
		}
	}
	$.prompt(formProperties);
}

/**
 * Disables a dom element by dom id
 *
 * @param id - dom id
 * @param enable - toggle flag
 */
function disableElement(id, enable){
  $('#'+id).prop('readonly',enable);
  $('#'+id).prop('disabled',enable);
}

function numberFormat(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}