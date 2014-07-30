$(document).ready(function(){
	$('.loadInvoice').click(function(){
		var invoiceID = $(this).attr('id').split('invoice_')[1];
		loadInvoice(invoiceID);
	});
  $('.printInvoice').click(function(){
    var invoiceID = $(this).attr('id').split('print_')[1];
    printInvoice(invoiceID);
  });
	$("#invoiceHistoryTbl").tablesorter();
});

/**
 * Loads an invoice selected
 */
function loadInvoice(invoiceID){
  if(invoiceID != ''){
    statusApp.showPleaseWait();
    var result = $.ajax({
      type: "POST",
      url: site_url+'invoices',
      async: false,
      data: {_id: invoiceID, dom_id: 'writer-invoice', _ajaxFunc: "renderPageElement"}
    });
    $('#writer-invoice').html(result.responseText);
    statusApp.hidePleaseWait();
    $("#invoiceDetailsTbl").tablesorter();
  }
}

/**
 * Prints an invoice selected
 */
function printInvoice(invoiceID){
  if(invoiceID != ''){
    statusApp.showPleaseWait();
    var result = $.ajax({
      type: "POST",
      url: site_url+'invoices',
      async: false,
      data: {_id: invoiceID, _ajaxFunc: "openInvoicePDF"}
    });
    var result = $.parseJSON(result.responseText);
    statusApp.hidePleaseWait();
    window.open(result.file_path, '_blank');
  }
}