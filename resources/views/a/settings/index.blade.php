<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1>Setting</h1>

        {{ Form::open(array('url' => '/a/settings', 'class' => 'booking-form')) }}

            <div class="row">
                <div class="form-group col-sm-8">
                    {{ Form::label('value', 'Default Access') }}
                    {{ Form::select('value', array('0' => 'Nobody', '1' => 'Guest', '2' => 'User', '3' => 'Admin'), Setting::get('default_access'), array('class' => 'form-control')) }}
                    {{ Form::hidden('key','default_access') }}
                </div>
                <div class="col-sm-4">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
        {{ Form::close() }}

    </div>
</div>
@endsection
