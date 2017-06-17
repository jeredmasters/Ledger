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
		eventLimit: true,
        events: window.calendar.events,
        dayClick: function(date, jsEvent, view, resourceObj) {
            $('#from').val(date.format());
            $('#to').val(date.add(1, 'day').format());
            $('#bookingForm').modal('show');
            checkDates();
        },
        eventClick: function (event){
            window.location = '/m/bookings/'+event.id+'/edit';
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
    while (from < to){
        conflict = checkDate(from, main, flat, studio);
        if (conflict !== false){
            break;
        }
        from = from.add(1, 'day');
    }

    if (conflict){
        $('#conflict-message').show();
        $('#bookingForm input[type="submit"]').prop('disabled', true);
        var text = [];
        for(var i in conflict){
            text.push(conflict[i].title + ": " + conflict[i].start.format('DD/MM/YYYY') + " - " + conflict[i].end.add(-1, 'day').format('DD/MM/YYYY'));
        };

        $('#conflict-info').html(text.join('<br/>'));
    }
    else{
        $('#conflict-message').hide();
        $('#bookingForm input[type="submit"]').prop('disabled', false);
    }

}
function checkDate(date, main, flat, studio){
    var e = _.filter(window.calendar.events, function (event){
        return (event.start < date && event.end >date) && (
            main && event.area == 'main' ||
            flat && event.area == 'flat' ||
            studio && event.area == 'studio'
        ) && (event.id != window.calendar.selectedEvent);
    });
    return (e.length > 0 ? e : false);
}
window.checkDates = checkDates;
