$(document).ready(function() { 
  $('#writer-schedule').fullCalendar({
    header: {
      left: '',
      center: 'title',
      right: ''
    },
    events: {
      url: site_url+'schedule',
      data: {
          _ajaxFunc: 'gatherScheduledEvents'
      }
    },
    eventRender: function(event, element) {
      if(event.description != ''){
        element.append('Description: '+event.description);
      }
    },
    firstDay: 1,
    defaultDate: $('#nextMonday').val(),
    defaultView: 'basicWeek',
    editable: false
  });
  $( "#datepicker" ).datepicker({ 
      firstDay: 1, 
      //Before Populating the Calendar set the Enabled & Disabled Dates using beforeShowDay(Date) function
      beforeShowDay: function (date) {

            //var monday = new Date("June 1, 2013 00:00:00"); Used it for testing
 
            //Get today's date
            var monday = new Date();
 
            //Set the time of today's date to 00:00:00 
            monday.setHours(0,0,0,0);
 
            //alert(monday.getDay() + ' : ' + monday.getDate() + ' : ' + (monday.getDay() || 7) + ' : ' + monday); Used it for testing
 
            /*
            Below Line sets the Date to Monday (Start of that Week)
            (monday.getDay() || 7) returns the value of getDay() 
            ie., [ 1 - Mon, 2 - Tue, 3 - Wed, 4 - Thu, 5 - Fri, 6 - Sat ]  
            except for Sunday where it returns 7. 
            The return value is used to calculate the Date of that Week's Monday
            */
            monday.setDate((monday.getDate() + 1 - (monday.getDay() || 7))+7);
 
            //Set the Date to Monday
            var sunday = new Date(monday);
 
            //Now add 6 to Monday to get the Date of Sunday (End of that Week)
            sunday.setDate(monday.getDate() + 6);
 
            //Now return the enabled and disabled dates to datepicker
            return [(date >= monday && date <= sunday), ''];
      }
  });
  $('#submitBtn').click(function(){
    saveTheDate();
  });
  $('#resetBtn').click(function(){
    $('#writer-schedule').fullCalendar( 'refetchEvents' );
  });
});

/**
 * Saves the scheduling date to the database under the writer
 */
function saveTheDate(){
  if($('#datepicker').val() == ''){
    popUpMsg('You need to pick a date!');
    return false;
  } else if($('#hours').val() == ''){
    popUpMsg('You need to select your amount of hours!');
    return false;
  }
  var docObj = {};
  docObj.url = 'schedule',
  docObj.collection = 'writers',
  docObj.set = 'schedule',
  docObj.values = {};
  docObj.values.title = '\nHours: ' + $('#hours').val();
  docObj.values.start = $('#datepicker').val();
  docObj.values.description = $('#description').val();
  addSetToDoc(docObj);
  $('#writer-schedule').fullCalendar( 'refetchEvents' );
}