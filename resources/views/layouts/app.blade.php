<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMDB</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="position:relative;min-height:100vh">
        <div style="padding-bottom:3.5rem">  
            <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <font color = "goldenrod"><b>BMDb</b></font>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link"href="/"style = "color: white">Home</a>
                            </li>
                            @if(Auth::user()['role'] == 'Member')
                            <li class="nav-item">
                                <a class="nav-link"href="/bookmarks"style = "color: white">Saved Movie</a>
                            </li>
                            @endif
                            @if(Auth::user()['role'] == 'Member' || Auth::user()['role'] == 'Admin')
                            <li class="nav-item">
                                <a class="nav-link"href="/inbox/{{Auth::user()->id}}"style = "color: white">Inbox</a>
                            </li>
                            @endif
                            @if(Auth::user()['role'] == 'Admin' )
                            <div class="dropdown show"style="color:white">
                                <a class="btn dropdown-toggle"style="color:white" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                                    Manage
                                </a>

                                <div class="dropdown-menu bg-dark shadow-sm" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item"style="color:grey" href="/user">Manage User</a>
                                    <a class="dropdown-item"style="color:grey" href="{{route('daftar.movie')}}">Manage Movie</a>
                                    <a class="dropdown-item"style="color:grey" href="/genre">Manage Genre</a>
                                </div>
                            </div>
                            @endif
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto" style = "color: white">
                            <!-- Authentication Links -->
                            <div id="time" class="nav-link"style = "color: white"></div>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"style = "color: white">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}"style = "color: white">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <div class="nav-item">
                                        <a href="{{url('/profile')}}"class="nav-link"style = "color: white">Profile</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-item" aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('logout') }}" style = "color:white"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>

    <footer class="page-footer font-small blue" style="background-color: #343a40; position:absolute; height:3.5rem; bottom:0; width:100%">
        <div class="footer-copyright text-center py-3" style="color:white">© 2019 Copyright:
            <a href="#"><font color = "goldenrod"><b>BMDb.com</b></font></a>
        </div>
    </footer>
    
    </div>
</body>

<script type="text/javascript">
      function showTime() {
        const options = {
            timeZone:"Asia/Jakarta",
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour12 : false,
            hour:  "2-digit",
            minute: "2-digit",
            second: "2-digit"
        }
        document.getElementById('time').innerHTML = new Date().toLocaleTimeString("en-US", options);
    }
    setInterval(showTime, 500);
</script>

</html>
