$(document).ready(function(){
	$('.toggleDesc').click(function(){
		var invoiceID = $(this).attr('id').split('invoice_')[1];
		$('#invoiceStatus').html($('#invoice_'+invoiceID+'_details').html());
		$('#invoiceDesc').html($('#invoice_'+invoiceID+'_desc').html());
	});
	$("#invoiceHistoryTbl").tablesorter();
});