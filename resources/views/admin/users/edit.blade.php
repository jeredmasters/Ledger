<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>Edit: {{ $user->name }}</h1>


    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('access', 'Access') }}
            {{ Form::select('access', array('0' => 'Nobody', '1' => 'Guest', '2' => 'User', '3' => 'Admin'), null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

  </div>
@endsection
