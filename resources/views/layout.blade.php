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
        <link href="/css/fullcalendar.min.css" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">

        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/moment.min.js"></script>
        <script src="/js/fullcalendar.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <a class="navbar-brand" href="#">Blue Orchid</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
