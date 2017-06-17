<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>Info</h1>
    <ul>
        <li><a href="/m/info/main">Main House</a></li>
        <li><a href="/m/info/flat">Flat</a></li>
        <li><a href="/m/info/studio">Studio</a></li>
    </ul>
  </div>

@endsection
