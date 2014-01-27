/**
 * Function that modifies the BLL Settings of the CMS system
 */
function updateBLLSettings(action){
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"settings",
    async: false,
    data: {action: action, _ajaxFunc: "updateBLLSettings"}
  });
  statusApp.hidePleaseWait();
}

/**
 * Function that modifies the BLL Forms of the CMS system
 */
function updateBLLForms(action){
  statusApp.showPleaseWait();
  $.ajax({
    type: "POST",
    url: site_url+"settings",
    async: false,
    data: {action: action, _ajaxFunc: "updateBLLForms"}
  });
  statusApp.hidePleaseWait();
}