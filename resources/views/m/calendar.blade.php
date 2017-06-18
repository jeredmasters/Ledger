<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Calendar</h1>
            <div id="calendar">
            </div>



        </div>
    </div>

@endsection
@section('footer')
    <!-- Modal -->
    <div class="modal fade" id="bookingForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Create Booking</h4>
                </div>
                <div class="modal-body">
                    @include('m.bookings.form', ['booking' => $newBooking])
                </div>
            </div>
        </div>
    </div>
    <script>
        var events = {!! json_encode($events) !!}
        window.calendar.events = _.forEach(events, function (event){
            event.start = moment(event.start + ' 01:01:01');
            event.end = moment(event.end + ' 23:59:59').add(1,'day');
            return event;
        });
    </script>
@endsection
