<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
  <div class="jumbotron">
    <h1>The Ledger</h1>
    <p>To get started please type in the password below. </p>
    <form action="/auth/check" method="POST" >
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
@endsection
