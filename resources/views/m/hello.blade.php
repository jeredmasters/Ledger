<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Hello {{$user->name}}, <i class="fa fa-smile-o" aria-hidden="true"></i> <i class="fa fa-hand-peace-o" aria-hidden="true"></i></h1>

            <img src="{{$user->getAvatar('large')}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br/>
            <br/>
            <h2>Get Started</h2>
        </div>
    </div>
    <div class="row quick-links">
        <div class="col-sm-4 col-lg-3 text-center">
            <a href="/m/calendar" class="btn btn-primary">Goto Calendar</a>
        </div>
        <div class="col-sm-4 col-lg-3 text-center">
            <a href="/m/bookings?onlyMe=1" class="btn btn-info">See my Bookings</a>
        </div>
        <div class="col-sm-4 col-lg-3 text-center">
            <a href="/m/info" class="btn btn-success">See info about the house</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br/>
            @if($thisWeekendAvailable)
                <div class="well">
                    <strong>This weekend is available! ({{ $thisWeekend }})</strong>
                </div>
            @else
                @if($nextWeekendAvailable)
                    <div class="well">
                        <strong>Next weekend is available! ({{ $nextWeekend }})</strong>
                    </div>
                @endif
            @endif
        </div>
    </div>

@endsection
