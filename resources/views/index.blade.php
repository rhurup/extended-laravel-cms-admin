<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
        <base href="https://skorstensgaard.dk/">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
        <link href="{{ url("/css/bootstrap.min.css")}}" rel="stylesheet"/>
        <link href="{{ url("/css/superfish.css")}}" rel="stylesheet" media="screen">
        <link href="{{ url("/css/fontawesome/fontawesome.min.css")}}" rel="stylesheet" media="screen">
        <link href="{{ url("/css/fontawesome/regular.min.css")}}" rel="stylesheet" media="screen">
        <link href="{{ url("/css/fontawesome/solid.min.css")}}" rel="stylesheet" media="screen">
        <link href="{{ url("/css/frontend.css")}}" rel="stylesheet" media="screen">
        @stack('css')
        <script src="{{ url("/js/jquery-3.6.3.min.js")}}"></script>
        <script src="{{ url("/js/bootstrap.bundle.min.js")}}"></script>

        <script src="{{ url("/js/hoverIntent.js")}}"></script>
        <script src="{{ url("/js/superfish.js")}}"></script>
        <script>
            $(document).ready(function () {
                $('#site-top-menu').superfish({
                    delay:       700,                            // one second delay on mouseout
                    animation:   {
                        opacity:'show',
                        height:'show'
                    },  // fade-in and slide-down animation
                    speed:       'fast',                          // faster animation speed
                    autoArrows:  true                            // disable generation of arrow mark-up
                });
            });
        </script>
        @stack('javascript')
    </head>
    <body class="body">
        @if(env("APP_ENV") != 'production')
            <div style="background-color: #ef4136; color: #FFF; text-align: center; width:100%;height:30px;position: relative;">
                Environment: <strong>{{env("APP_ENV")}}</strong>
            </div>
        @endif
        <!-- Navbar -->
        <x-menus position="top" />

        <div class="container content">
            <x-modules position="top" />
            @yield('content')
            <x-modules position="bottom" />
        </div>

        <div class="container-fluid footer fixed-bottom">
            <x-modules position="footer" />
        </div>
    </body>
</html>
