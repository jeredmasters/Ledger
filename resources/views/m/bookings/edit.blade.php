<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>Edit: {{ $booking->name }}</h1>


    {{ Form::model($booking, array('route' => array('bookings.update', $booking->id), 'method' => 'PUT')) }}

        <div class="row booking-form">
            <div class="form-group col-sm-12">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group col-sm-12">
                {{ Form::label('from', 'From') }}
                {{ Form::date('from', $booking->from, array('class' => 'form-control')) }}
            </div>

            <div class="form-group col-sm-12">
                {{ Form::label('to', 'To') }}
                {{ Form::date('to', $booking->to, array('class' => 'form-control')) }}
            </div>

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


  </div>
    <script>
        $(document).ready(function (){
            setTimeout(function (){
                window.checkDates();
            }, 500);
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