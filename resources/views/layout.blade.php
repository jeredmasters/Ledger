<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico">

        <title>App Name - @yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href="/css/fullcalendar.min.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">

        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/moment.min.js"></script>
        <script src="/js/fullcalendar.min.js"></script>
        <script src="/js/lodash.js"></script>
        <script src="/js/app.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/m/hello">{{ $userName }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @if($userAccess >= 2)
                            <li><a href="/m/calendar">Calendar</a></li>
                            <li><a href="/m/bookings?onlyMe=1">Bookings</a></li>
                        @endif
                        @if($userAccess >= 1)
                            <li><a href="/m/info">Info</a></li>
                        @endif
                        @if($userAccess >= 3)
                            <li><a href="/admin/users">Users</a></li>
                        @endif
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        @yield('footer')
    </body>
</html>
