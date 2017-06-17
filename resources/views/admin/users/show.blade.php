<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>User: {{ $user->name }}</h1>
    <div class="jumbotron text-center">
        <h2>{{ $user->name }}</h2>
        <p>
            <strong>AuthID:</strong> {{ $user->oauth_id }}<br>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Level:</strong> {{ $user->access }}
        </p>
    </div>


  </div>
@endsection
