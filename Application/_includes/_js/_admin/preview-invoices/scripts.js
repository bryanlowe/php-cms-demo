$(document).ready(function(){
	$('#clients_select').change(function(){
	    if($(this).val() != ""){
	      	reloadFormElement('invoice_entries', 'preview-invoices', $(this).val());
	      	$('.toggleDesc').click(function(){
				var invoiceID = $(this).attr('id').split('invoice_')[1];
				$('#invoiceDesc').html($('#invoice_'+invoiceID+'_desc').html());
			});
	    } else {
	      	reloadFormElement('invoice_entries', 'preview-invoices');
	    }
	});
	$("#invoiceHistoryTbl").tablesorter();
});