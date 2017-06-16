<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
  <div class="jumbotron">
    <h1>Booking: {{ $booking->name }}</h1>
    <div class="jumbotron text-center">
        <h2>{{ $booking->name }}</h2>
        <p>
            <strong>Name:</strong> {{ $booking->name }}<br>
            <strong>From:</strong> {{ $booking->from->format('l d/m/Y') }}<br>
            <strong>To:</strong> {{ $booking->to->format('l d/m/Y') }}
            <strong>Main:</strong> {{ $booking->main }}
            <strong>Flat:</strong> {{ $booking->flat }}
            <strong>Studio:</strong> {{ $booking->studio }}
        </p>
        <p>
            {!! json_encode($booking->toEvents()) !!}
        </p>
    </div>


  </div>
@endsection
