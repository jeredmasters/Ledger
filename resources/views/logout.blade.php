<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>Logging out with facebook...</h1>
  </div>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1466337873389098',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.getLoginStatus(function(response) {
        if (response.status == 'connected'){
            FB.logout(function(){
                window.location = '/';
            });
        }
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
@endsection
