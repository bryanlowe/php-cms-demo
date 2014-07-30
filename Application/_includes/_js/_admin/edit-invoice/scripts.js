$(document).ready(function(){
  $('#writers_select').change(function(){
    writers_select();
  });
  $('input[name="toggle_invoice"]').click(function(){
    updateInvoiceSelect();
  });
  $('#loadBtn').click(function(){
    loadInvoice();
  });
  $('#paidBtn').click(function(){
    saveInvoiceStatus('PAID');
  });
  $('#openBtn').click(function(){
    saveInvoiceStatus('OPEN');
  });
  $('#resetBtn').click(function(){
    $('#writers_select').prop('selectedIndex',0);
    $('#writers_select').change();
  });
  $('#deleteBtn').click(function(){
    deleteInvoice();
  });
  $('#writers_select').change();
});

function writers_select(){
  if($('#writers_select').val() != ''){
    $('#invoices_select').prop('disabled', false);
    $('#loadBtn').prop('disabled', false);
    $('#paidBtn').prop('disabled', false);
    $('#openBtn').prop('disabled', false);
    $('#deleteBtn').prop('disabled', false);
    updateInvoiceSelect();
  } else {
    $('#invoices_select').prop('selectedIndex',0);
    $('#invoices_select').prop('disabled', true);
    $('#loadBtn').prop('disabled', true);
    $('#paidBtn').prop('disabled', true);
    $('#openBtn').prop('disabled', true);
    $('#deleteBtn').prop('disabled', true);
  }
  $('input[name="toggle_invoice"]').prop('disabled', false);
  reloadFormElement('writer-invoice', 'edit-invoice');
}

/**
 * Loads an invoice selected
 */
function loadInvoice(){
  if($('#invoices_select').val() != ''){
    statusApp.showPleaseWait();
    var result = $.ajax({
      type: "POST",
      url: site_url+'edit-invoice',
      async: false,
      data: {_id: $('#invoices_select').val(), dom_id: 'writer-invoice', _ajaxFunc: "renderPageElement"}
    });
    $('#writer-invoice').html(result.responseText);
    $('input[name="toggle_invoice"]').prop('disabled', true);
    $('#invoices_select').prop('disabled', true);
    statusApp.hidePleaseWait();
    $("#invoiceTbl").tablesorter();
  }
}

/**
 * Updates the invoice select dropdown
 */
function updateInvoiceSelect(){
  if($('#writers_select').val() != ''){
    statusApp.showPleaseWait();
    var result = $.ajax({
      type: "POST",
      url: site_url+'edit-invoice',
      async: false,
      data: {_id: $('#writers_select').val(), invoice_toggle: $('input[name="toggle_invoice"]:checked').val(), dom_id: 'invoices_select_container', _ajaxFunc: "renderPageElement"}
    });
    $('#invoices_select_container').html(result.responseText);
    statusApp.hidePleaseWait();
  }
}

/**
 * Removes a work entry from the invoice document
 */
function removeWorkEntry(work_id){
  var docObj = {};
  docObj.url = 'edit-invoice',
  docObj.collection = 'invoices',
  docObj.set = 'task_list',
  docObj.values = {};
  docObj.values.work_id = work_id;
  docObj._id = $('#invoices_select').val();
  docObj.mongoid = 1;
  removeSetFromDoc(docObj);
  loadInvoice();
}

function saveInvoiceStatus(status){
  $('#invoices_select').prop('disabled', false);
  if($('#invoices_select').val() != ''){
    var docObj = {};
    docObj._id = $('#invoices_select').val();
    docObj.values = {};
    docObj.values.invoice_status = status;
    docObj.url = site_url+'edit-invoice';
    docObj.collection = 'invoices';
    docObj.mongoid = 1;
    var results = saveEntry(docObj);
    if(results.err == null){
      popUpMsg("Save was successful!");
      $('#resetBtn').click(); 
      return true;
    } else {
      popUpMsg(results.err);
      return false;
    }
  }
  $('#invoices_select').prop('disabled', true);
}

/**
 * Creates a deletion prompt that asks the user if they are sure they want to delete the entry, then 
 * creates a document from the form before sending it to the delete feature
 */
function deleteInvoice(){
  if($('#invoices_select').val() != ''){
    var result = "";
    $.prompt("<p>Are you sure you want to delete this entry?</p>", {
      title: "Are you sure?",
      buttons: { "Yes": true, "No": false },
      submit: function(e,v,m,f){ 
        if(v){
          docObj = {};
          docObj._id = $('#invoices_select').val();
          docObj.url = site_url+'edit-invoice';
          docObj.collection = 'invoices';
          docObj.mongoid = 1;
          var results = deleteEntry(docObj);
          if(results.err == null){
            $('#resetBtn').click(); 
          }
        }
        $.prompt.close();
      }
    });
  } else {
    popUpMsg('You cannot delete an entry that has not been saved!');
  }
}