<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Delphi</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Top navigation bar -->
    <div id="topNav">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                @guest
                <!-- User not logged in navigation bar -->
                <ul class="nav navbar-nav navbar-left">
                    <li> <a class="navbar-brand" href="{{ url('/') }}"> Delphi </a></li> 
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <a class="nav-link" href="{{ route('login') }}"> <span class="glyphicon glyphicon-log-in"></span> Login</a>
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <a class="nav-link" href="{{ route('register') }}"> <span class="glyphicon glyphicon-user"></span> Register</a>
                </ul>
                @else
                <!-- User logged in navigation bar -->
                <ul class="nav navbar-nav navbar-left">
                    <li> <a class="navbar-brand" href="{{ url('/') }}"> Delphi </a></li> 
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span> Home </a></li> 
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <li> <a href="{{ route('stats') }}"> <span class="glyphicon glyphicon-stats"></span> Stats </a> </li>
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <li> <a href="{{ route('profile') }}"> <span class="glyphicon glyphicon-user"></span> Profile </a> </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"> </span> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

                @endguest
            </div>
        </nav>
    </div>
    <main class="py-4">
            @yield('content')
    </main>
    </div>
</body>
</html>
