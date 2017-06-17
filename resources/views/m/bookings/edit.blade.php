<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
    <div class="jumbotron">
        <h1>Edit Booking</h1>


        {{ Form::model($booking, array('route' => array('bookings.update', $booking->id), 'method' => 'PUT', 'class'=>'booking-form')) }}

            <div class="row">
                <div class="form-group col-sm-6">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group col-sm-6">
                    {{ Form::label('type', 'Type') }}
                    {{ Form::select('type', array('1' => 'Tentative', '2' => 'Locked In'), $booking->type, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    {{ Form::label('from', 'From') }}
                    {{ Form::date('from', $booking->from, array('class' => 'form-control')) }}
                </div>

                <div class="form-group col-sm-6">
                    {{ Form::label('to', 'To') }}
                    {{ Form::date('to', $booking->to, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group area-checkbox" style="background-color: {{config('areas.main.color')}}" for="main">
                        {{ Form::label('main', 'Main', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('main', true) }}
                    </div>

                    <div class="form-group area-checkbox" style="background-color: {{config('areas.flat.color')}}">
                        {{ Form::label('flat', 'Flat', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('flat', true) }}
                    </div>

                    <div class="form-group area-checkbox" style="background-color: {{config('areas.studio.color')}}">
                        {{ Form::label('studio', 'Studio', ['class' => 'checkbox-label']) }}
                        {{ Form::checkbox('studio', true) }}
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="conflict-message" id="conflict-message">

                        <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There's a conflit with the dates you've selected: </p>
                        <span id="conflict-info"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                </div>
            </div>

        {{ Form::close() }}
        {{ Form::open(array('url' => '/m/bookings/' . $booking->id, 'class' => 'pull-right')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
    </div>
    <script>
        $(document).ready(function (){
            setTimeout(function (){
                window.checkDates();
            }, 100);
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
