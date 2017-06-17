<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>The Ledger</h1>
    <fb:login-button
      scope="public_profile,email"
      onlogin="checkLoginState();">
    </fb:login-button>
  </div>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1466337873389098',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
    checkLoginState();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function checkLoginState(){
       FB.getLoginStatus(function(response) {
           console.log(response);
           if (response.status == 'connected'){
               pushToken(response.authResponse.accessToken);
           }
       });
   }
   function pushToken(token){
       window.location = '/login/facebook/push?token=' + token;
   }

</script>
@endsection
