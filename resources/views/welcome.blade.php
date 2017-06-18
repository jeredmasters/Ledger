<!-- Stored in resources/views/child.blade.php -->

@extends('layout')

@section('title', 'Page Title')

@section('content')
  <div class="jumbotron">
    <h1>The Ledger</h1>
    <p>Click the login button below to get started!</p>
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
      version    : 'v2.8',
      channelUrl : 'http://ledger.jered.cc/channel.html'
    });
    FB.AppEvents.logPageView();
    checkLoginState();
  };

  (function(d, s, id){
     if (isSafari()){
         window.location = '/login/facebook';
     }
     else{
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
     }
   }(document, 'script', 'facebook-jssdk'));

   function checkLoginState(){
       FB.getLoginStatus(function(response) {
           if (response.status == 'connected'){
               pushToken(response.authResponse.accessToken);
           }
       });

   }
   function pushToken(token){
       window.location = '/login/facebook/push?token=' + token;
   }
   function isSafari(){
       var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('safari') != -1) {
          if (ua.indexOf('chrome') == -1) {
            return false; // Chrome
          } else {
            return true; // Safari
          }
        }

        return false;
   }

</script>
@endsection
