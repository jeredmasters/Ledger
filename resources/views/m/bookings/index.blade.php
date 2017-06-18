<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1>Bookings</h1>

        <form class="bookings-filter">
            <div class="row">
                <div class="form-group col-sm-4 checkbox">
                    {{ Form::label('onlyMe', 'Show only my bookings') }}
                    {{ Form::checkbox('onlyMe', true, old('onlyMe', false)) }}
                </div>
                <div class="col-sm-4">
                    {{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        </form>


        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Days</td>
                    <td>Name</td>
                    <td>Areas</td>
                    <td>UserID</td>
                </tr>
            </thead>
            <tbody>
            @foreach($bookings as $key => $value)
                <tr>
                    <td>{{ $value->from->format('Y-m-d') }}</td>
                    <td>{{ $value->to->diffInDays($value->from) }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->areas() }}</td>


                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the booking (uses the destroy method DESTROY /bookings/{id} -->
                        {{ Form::open(array('url' => '/m/bookings/' . $value->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}

                        <!-- show the booking (uses the show method found at GET /bookings/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('/m/bookings/' . $value->id) }}">Show</a>

                        <!-- edit this booking (uses the edit method found at GET /bookings/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('/m/bookings/' . $value->id . '/edit') }}">Edit</a>

                    </td>
                </tr>
            @endforeach
            </tbody>

    </div>
</div>
@endsection
