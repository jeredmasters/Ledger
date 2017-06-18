<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
    <div class="">
        <div class="jumbotron">
            <h1>Log</h1>
            <p>
                <strong>Timestamp: </strong> {{ $log->created_at }}<br/>
                <strong>User: </strong> {{ $log->user->name }}<br/>
                <strong>Event: </strong> {{ $log->event }}<br/>
                <strong>Item: </strong> {{ ucfirst($log->item_type) }}: {{ $log->item }}<br/>
                <strong>Data: </strong> {!! str_replace("\n",'<br/>',print_r($log->data, true)) !!}
            </p>
        </div>
    </div>
@endsection
