<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="logo"> <a href="../"> <img src="\images\logo.png" alt="logo"> </a></div> 

            <div class="container">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else

                            @if (Auth::user()->role_id == 1) {{-- if admin --}}
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('workers')}}">Manage workers<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('clients')}}">Manage clients<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('admin.orders')}}">All Orders <span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('admin.settings')}}">Post settings<span class="sr-only"></span></a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 2) {{-- if postal worker --}}
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">My orders<span class="sr-only"></span></a>
                                    </li>
                            @endif

                            @if (Auth::user()->role_id == 3) {{-- if seller --}}
                                <li class="nav-item active">
                                    <a class="nav-link" href="/order">New Order<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="/orders">All Orders <span class="sr-only"></span></a>
                                </li>
                            @endif
                        @endguest 
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="#">Reset Password</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
