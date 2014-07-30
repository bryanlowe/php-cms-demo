$(document).ready(function(){
    $('#zip_container').css('padding-left', '40px');
    $('#client_name_container').addClass('col-lg-offset-1');
    $('#phone_number_container').addClass('col-lg-offset-1');
    $('#city_container').addClass('col-lg-offset-1');
    $('#zip_container').addClass('col-lg-offset-1');
    $('<h3>Required Fields:</h3>').insertBefore('#company_container');
    $('<div class="clear"><hr></div><h3>Optional Fields:</h3>').insertBefore('#address_container');
	$('#submitBtn').click(function(){
        saveAccount();
    });

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
                var projectEntry = '<p style="font-size:12px; white-space: nowrap;">#'+projectInc+': Words - '+$("#price").val()+', Pieces - '+$("#priceb").val()+', Total - <input name="project_'+projectInc+'_total" type="text" id="project_'+projectInc+'_total" readonly value="'+$("#total").val()+'" class="priceInput" /></p>';
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
    }
	// END QUOTE CALCULATOR
});

/**
 * Validates the form and creates a document from the form before passing it to the save feature
 *
 * @param collection - mongo collection
 * @param mongoid - flags whether a mongo id object was used as an id number
 */
function saveAccount(){
  if(validateForm('clients_form') != false){
    var docObj = createDocFromForm('clients_form');
    docObj._id = $('#clients_form #_id').val();
    docObj.url = site_url+'account';
    docObj.collection = 'clients';
    docObj.mongoid = true;
    var results = saveEntry(docObj);
    if(results.err == null){
      popUpMsg("Save was successful!");
      return true;
    } else {
      popUpMsg(results.err);
      return false;
    }
  }
  return false;
}