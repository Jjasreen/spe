<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPE') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
  </head>
<body>
<div id="app">
    <nav class="navbar navbar-dark" style="background-color: black; color: white;">
        <div class="d-flex" style="background-color: black;">
            <a class="navbar-brand"style="background-color:black;"><img src="{{ URL::asset('img/logo.png') }}" alt=""></a>
            <div>
                <h1>SELF AND PEER EVALUATION PORTAL</h1>
                @guest
                    <div class="d-flex">
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                    </div>
                @else
                    <div class="d-flex">
                        @if (Auth::user()->role == "UC")
                            <div class="mr-3">Welcome, {{Auth::user()->username}} (Unit Coordinator)<div>
                            <a class="nav-link" href="/home">Home</a>
                            <a class="nav-link" href="/spe_surveys">SPE</a>
                            <a class="nav-link" href="/upload">Students</a>
                            <a class="nav-link" href="/modules">Modules</a>
                            <a class="nav-link" href="/exportscore">Export Score</a>
                        @elseif (Auth::user()->role == 'admin')
                            <div class="mr-3">Welcome, {{Auth::user()->username}} (Admin)<div>
                            <a class="nav-link" href="/unit_coordinators">Unit Coordinators</a>
                            <a class="nav-link" href="/modulesadmin">Modules</a>
                            <a class="nav-link" href="/admins">Administrators</a>
                        @endif
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

  
    <div class="container-fluid">
    @yield('content')
    </div>

</div>
</body>
</html>

