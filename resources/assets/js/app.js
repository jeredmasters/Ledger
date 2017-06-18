window.calendar = {

};

$(document).ready(function (){
    $('#bookingForm').modal('hide');
    $('#from').change(checkDates);
    $('#to').change(checkDates);
    $('#main').change(checkDates);
    $('#flat').change(checkDates);
    $('#studio').change(checkDates);
    $('#calendar').fullCalendar({
        header: {"right":"prev,next","left":"title"},
		eventLimit: false,
        events: window.calendar.events,
        dayClick: function(date, jsEvent, view, resourceObj) {
            window.calendar.selectedEvent = -1;
            $('#from').val(date.format());
            $('#to').val(date.add(1, 'day').format());
            $('#bookingForm').modal('show');
            checkDates();
        },
        eventClick: function (event){
            window.location = '/m/bookings/'+event.id+'/edit';
        },
        eventRender: function(event, element) {
            if (event.type == 2){
                element.html(event.title + ' <i class="fa fa-lock" aria-hidden="true"></i>');
            }
            if (event.type == 1){
                element.html(event.title + ' <i class="fa fa-question" aria-hidden="true"></i>');
            }
        }
    });
});

function checkDates(){
    var from = moment($('#from').val()).add(1, 'day');
    var to = moment($('#to').val()).add(2, 'day');
    var main = $('#main').is(":checked");
    var flat = $('#flat').is(":checked");
    var studio = $('#studio').is(":checked");

    var conflict = false;
    if (!(main||flat||studio)){
        $('#conflict-message').hide();
        $('#bookingForm input[type="submit"]').prop('disabled', true);
    }
    else{
        while (from < to){
            conflict = checkDate(from, main, flat, studio);
            if (conflict !== false){
                break;
            }
            from = from.clone().add(1, 'day');
        }

        if (conflict){
            $('#conflict-message').show();
            $('#bookingForm input[type="submit"]').prop('disabled', true);
            var text = [];
            for(var i in conflict){
                text.push(conflict[i].title + ": " + conflict[i].start.format('DD/MM/YYYY') + " - " + conflict[i].end.clone().add(-1, 'day').format('DD/MM/YYYY'));
            };

            $('#conflict-info').html(text.join('<br/>'));
        }
        else{
            $('#conflict-message').hide();
            $('#bookingForm input[type="submit"]').prop('disabled', false);
        }
    }

}
function checkDate(date, main, flat, studio){
    var e = _.filter(window.calendar.events, function (event){
        if(date >= event.start && date <= event.end){
            if( main && event.area == 'main' ||
                flat && event.area == 'flat' ||
                studio && event.area == 'studio'
            ){
                if(event.id != window.calendar.selectedEvent){
                    return true;
                }
            }
        }
        return false;
    });
    return (e.length > 0 ? e : false);
}
window.checkDates = checkDates;
