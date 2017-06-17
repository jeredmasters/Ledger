<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>Create User</h1>
    <!-- if there are creation errors, they will show here -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::open(array('url' => '/admin/users')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('user_level', 'User Level') }}
            {{ Form::select('user_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), Input::old('user_level'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create the User!', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

  </div>
@endsection
