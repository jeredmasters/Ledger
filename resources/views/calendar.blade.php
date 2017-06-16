<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
  <div class="jumbotron">
    <h1>Calendar</h1>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}

  </div>
@endsection
