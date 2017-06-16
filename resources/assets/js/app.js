window.calendar = {

    dayClick: function(date, jsEvent, view) {
        alert('Clicked on: ' + date.format());

        // change the day's background color just for fun
        $(this).css('background-color', 'red');
    }
};
