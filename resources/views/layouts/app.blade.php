<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/product-details-style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/all.css')}}" type="text/css">

    @yield('extra-css')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                                    <a class="nav-link" href="{{route('admin.newOrders')}}">Orders <span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('postalsettings')}}">Post settings<span class="sr-only"></span></a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 2) {{-- if postal worker --}}
                                <li class="nav-item active">
                                    <a class="nav-link" href="/postalworker">My orders<span class="sr-only"></span></a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 3 && Auth::user()->isActive) {{-- if seller --}}
                                <li class="nav-item active">
                                    <a class="nav-link" href="/order">New Order<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="/orders">All Orders <span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="/newProduct">New Product<span class="sr-only"></span></a>
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
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Register <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            {{ __('As seller') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('registerBuyer') }}">
                                            {{ __('As buyer') }}
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role_id == 4 && Auth::user()->isActive) {{-- if buyer --}}
                            <li class="nav-item">
                                <a href="/cart" class="nav-link" >
{{--                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;--}}
                                    Cart
                                    <span class="badge badge-secondary badge-pill">{{$cartItems}}</span>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->isActive)
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
                            @endif
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.track.view') }}">{{ __('Track order') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>

@section('extra-js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@show

</body>
</html>
