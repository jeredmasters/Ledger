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
        $('#conflict-info').html(conflict.title + ": " + conflict.start.format('MM/DD/YYYY') + " - " + conflict.end.format('MM/DD/YYYY'));
    }
    else{
        $('#conflict-message').hide();
        $('#bookingForm input[type="submit"]').prop('disabled', false);
    }

}
function checkDate(date, main, flat, studio){
    var e = _.filter(window.calendar.events, function (event){
        return (event.start < date && event.end >date) && (
            event.main && main ||
            event.flat && flat ||
            event.studio && studio
        );
    });
    return (e.length > 0 ? _.first(e) : false);
}
