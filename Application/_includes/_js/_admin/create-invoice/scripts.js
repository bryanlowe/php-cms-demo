var invoice_attrs = [],
    invoice_total = 0;
$(document).ready(function(){
  $('#writers_select').change(function(){
    writers_select();
  });
  $('#createBtn').click(function(){
    createInvoice();
  });
  $('#submitBtn').click(function(){
    saveInvoice();
  });
  $('#resetBtn').click(function(){
    $('#writers_select').prop('selectedIndex',0);
    $('#writers_select').change();
  });
  $("#start_date").datepicker();
  $("#end_date").datepicker();
  $('#writers_select').change();
});

function writers_select(){
  if($('#writers_select').val() != ''){
    $('#start_date').val('');
    $('#start_date').prop('disabled', false);
    $('#end_date').val('');
    $('#end_date').prop('disabled', false);
    $('#createBtn').prop('disabled', false);
    $('#submitBtn').prop('disabled', false);
  } else {
    $('#start_date').val('');
    $('#start_date').prop('disabled', true);
    $('#end_date').val('');
    $('#end_date').prop('disabled', true);
    $('#createBtn').prop('disabled', true);
    $('#submitBtn').prop('disabled', true);
  }
  reloadFormElement('writer-invoice', 'create-invoice');
  invoice_attrs = [];
  invoice_total = 0;
}

function createInvoice(){
  if($('#writers_select').val() != ''
  && $('#start_date').val() != ''
  && $('#end_date').val() != ''){
    statusApp.showPleaseWait();
    var result = $.ajax({
      type: "POST",
      url: site_url+'create-invoice',
      async: false,
      data: {_id: $('#writers_select').val(), start_date: $('#start_date').val(), end_date: $('#end_date').val(), dom_id: 'writer-invoice', _ajaxFunc: "renderPageElement"}
    });
    $('#writer-invoice').html(result.responseText);
    statusApp.hidePleaseWait();
    $("#invoiceTbl").tablesorter();
  }
}

function saveInvoice(){
  if($('#writers_select').val() != ''
  && invoice_attrs.length > 0
  && invoice_total != '0'){
    statusApp.showPleaseWait();

    var docObj = {};
    docObj.values = {};
    docObj.values.invoice_cost = invoice_total;
    docObj.values.task_list = invoice_attrs;
    docObj.values.writer_id = $('#writers_select').val();
    docObj.values.period_start = $('#start_date').val();
    docObj.values.period_end = $('#end_date').val();
    docObj.values.invoice_status = 'OPEN';

    var results = $.ajax({
      type: "POST",
      url: site_url+'create-invoice',
      async: false,
      data: {doc: docObj, _ajaxFunc: "saveInvoice"}
    });
    
    results = results.responseText;
    statusApp.hidePleaseWait();
    if(results.err == null){
      popUpMsg("Save was successful!");
      $('#resetBtn').click();
      return true;
    } else {
      popUpMsg(results.err);
      return false;
    }
  }
}