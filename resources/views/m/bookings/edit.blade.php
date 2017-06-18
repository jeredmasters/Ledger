<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
    <div class="jumbotron">
        <h1>Edit Booking</h1>


        @include('m.bookings.form', ['booking' => $booking])


    </div>
    <script>
        $(document).ready(function (){
            setTimeout(function (){
                window.checkDates();
            }, 50);
        });
        var events = {!! json_encode($events) !!}
        window.calendar.events = _.forEach(events, function (event){
            event.start = moment(event.start + ' 01:01:01');
            event.end = moment(event.end + ' 23:59:59').add(1,'day');
            return event;
        });
        window.calendar.selectedEvent = {{$booking->id}};
    </script>
@endsection
