$(document).ready(function(){
	$('.toggleDesc').click(function(){
		var invoiceID = $(this).attr('id').split('invoice_')[1];
		$('#invoiceDesc').html($('#invoice_'+invoiceID+'_desc').html());
	});
	$("#invoiceHistoryTbl").tablesorter();
});