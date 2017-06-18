<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>System Log</h1>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Timestamp</td>
                <td>User</td>
                <td>Event</td>
                <td>Item</td>
            </tr>
        </thead>
        <tbody>
        @foreach($logs as $key => $log)
            <tr>
                <td>{{ $log->created_at->format('Y-m-d') }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->event }}</td>
                <td>{{ ucfirst($log->item_type) }}: {{ $log->item }}</td>

                <!-- we will also add show, edit, and delete buttons -->
                <td>

                    <!-- show the user (uses the show method found at GET /users/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('/a/log/' . $log->id) }}">Show</a>

                </td>
            </tr>
        @endforeach
        </tbody>

  </div>
@endsection
