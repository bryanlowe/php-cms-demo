$(document).ready(function(){
	$("#client_name_container").insertBefore($("#company_container"));
	$("#client_name_container label").html("Name");
	$("#client_id_container").remove();
	$("#clients_form").append('<input type="hidden" class="primaryKey" id="client_id" />')
	$("#client_id").val($("#client_id_holder").val())
	$("#client_rate_container").hide();
	$("#client_rate").attr("readonly",true);
	$(".deleteBtn_container").remove();
	$("input[name='saveBtn']").val("UPDATE");
	updateBLLFormFields('clients_form','clients',site_url+'account');

	// START QUOTE CALCULATOR
    var projectInc = 1;
    if(Number($('#client_rate').val()) != 0){
        $("#total").val("$0.00");
        $("#project_total").val("$0.00");
        $("#amount").val("Words?");
        $("#amountb").val("Pieces?");

        $("#updateQuote").click(function(){
            var total = $("#total").val();
            total = Number(total.replace('$','').replace(',',''));
            var project_total = $("#project_total").val();
            project_total = Number(project_total.replace('$','').replace(',',''));
            if(total > 0){
                project_total = project_total + total;
                $("#project_total").val('$'+numberFormat(project_total.toFixed(2)));
                var projectEntry = '<p style="font-size:12px; white-space: nowrap;">Project #'+projectInc+': Words - '+$("#price").val()+', Pieces - '+$("#priceb").val()+', Total - <input name="project_'+projectInc+'_total" type="text" id="project_'+projectInc+'_total" readonly value="'+$("#total").val()+'" class="priceInput" /></p>';
                $(projectEntry).insertBefore("#project_total_container");
                projectInc++;
            }
        });

        $( function() {
            var wordsA = {
                0: "0",
                1: "250",
                2: "300",
                3: "500",
                4: "800",
                5: "1000"
            };
            var wordsB = {
                0: "0",
                1: "250",
                2: "300",
                3: "500",
                4: "800",
                5: "1000"
            };
            var piecesA = {
                0: "0",
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
                6: "10",
                7: "20",
                8: "50",
                9: "100"

            };
            var piecesB = {
                0: "0",
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
                6: "10",
                7: "20",
                8: "50",
                9: "100"

            };
            
            $("#slider").slider({
                value: "0",
                min: 0,
                max: 5,
                step: 1,
                slide: function(event, ui) {
                    $("#price").val(wordsB[ui.value]);
                    //$("#amount").val(wordsA[ui.value]);
                    var aaa = Number($("#price").val());
                    var bbb = Number($("#priceb").val());
                    var newTotal = '$'+numberFormat((aaa*bbb*Number($('#client_rate').val())).toFixed(2));
                    $("#total").val(newTotal);
                }
            });

            $("#sliderb").slider({
                value: "0",
                min: 0,
                max: 9,
                step: 1,
                slide: function(event, ui) {
                    $("#priceb").val(piecesB[ui.value]);
                    //$("#amountb").val(piecesA[ui.value]);
                    var aaa = Number($("#price").val());
                    var bbb = Number($("#priceb").val());
                    var newTotal = '$'+numberFormat((aaa*bbb*Number($('#client_rate').val())).toFixed(2));
                    $("#total").val(newTotal);
                }
            });
            
            $("#price").val('$' + $("#slider").slider("value"));
            $("#priceb").val('$' + $("#slider").slider("value"));

            $("#price").val("0");
            $("#priceb").val("0");
        });
    } else {
        var now = new Date();
        var thisYear = now.getFullYear();
        var noRateMsg = '<p>Looks like you don&#39;t have an established per word rate. Make an appt with Amie for your initial consult or use our <a href="https://contentequalsmoney.com/price1/" target="_blank">pricing wizard</a> to find your rate. Once your rate is established it stays consistent for any project in '+thisYear+'.</p>';
        $('#rateCalc').html(noRateMsg);
    }
	// END QUOTE CALCULATOR
});

/**
 * Saves the account form
 */
function saveClient(){
	var results = saveEntry('Clients');
	if(results.length > 0){
		if(results[0] == 'error'){
			popUpMsg("Form is not complete!");
   			displayErrors(results[1], 'clients');
    		return false;
	  	} else if(results[0] == 'duplicate'){
	    	popUpMsg("This client already exists!");
	    	return false;
	  	} else if(results[0] == 'pass') {
	    	popUpMsg("Your account was saved successfully!");
	    	return true;
	  	}
	}
}