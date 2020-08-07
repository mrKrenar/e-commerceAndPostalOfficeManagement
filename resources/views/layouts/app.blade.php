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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/navbar-style.css')}}" type="text/css">

    @yield('extra-css')

</head>
<body>
    <div id="app">
        <header class="main-header">
            <!-- Start Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
                <div class="container">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}">Fant4st1cs</a>
                    </div>
                    <!-- End Header (brands) Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav mr-auto" data-in="fadeInDown" data-out="fadeOutUp">
                            @guest
                            @else

                            @if (Auth::user()->role_id == 1) {{-- if admin --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('workers')}}">Manage Employees</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('clients')}}">Manage Clients</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.newOrders')}}">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('postalsettings')}}">Post settings</a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 2) {{-- if postal worker --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="/postalworker">My orders<span class="sr-only"></span></a>
                                </li>
                            @endif

                            @if (Auth::user()->role_id == 3 && Auth::user()->isActive) {{-- if seller --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="/order">New Order<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/orders">All Orders <span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/newProduct">New Product<span class="sr-only"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('allProducts')}}">All Products<span class="sr-only"></span></a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->

                        <ul style="margin-top: 5px" class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.track.view') }}">{{ __('Track Order') }}</a>
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if(Route::has('register'))
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Register</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('register') }}">
                                        {{ __('As seller') }}
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('registerBuyer') }}">
                                        {{ __('As buyer') }}
                                    </a></li>
                                </ul>
                            </li>
                            @endif
                            <li>
                                <div class="attr-nav" style="margin-top: 3px; margin-left: -15px; margin-right: -15px;">
                                    <ul>
                                        <li class="search"><a><i class="fa fa-search"></i></a></li>
                                    </ul>
                                </div>
                            </li>
                        @else

                            @if (Auth::user()->isActive)
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->role_id == 4)
                                    <li>
                                        <a href={{route('purchaseHistory', Auth::user()->id)}}>My Purchases</a>
                                    </li>
                                        @endif
                                        <li><a href="{{ route('password.request') }}">Reset Password</a></li>
                                        <li><a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </ul>
                            @endif
                            @if(Auth::user()->role_id == 4 && Auth::user()->isActive) {{-- if buyer --}}
                            <li>
                            <div class="attr-nav" style="margin-top: 5px">
                                <ul>
                                    <li class="search"><a><i class="fa fa-search"></i></a></li>
                                    <li class="side-menu">
                                        <a href="/cart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            {{-- <i class="fa fa-shopping-bag"></i> --}}
                                            <span class="badge">&nbsp;&nbsp;{{$cartItems}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>

            <div class="side">
                <a class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        @if (Auth::check() && $cartItems > 0)
                            @for ($i = 0; $i < $cartItems; $i++)
                                <li>
                                    <a href="#" class="photo"><img src=" ../storage/images/{{$productsImage[$i][0]->path}} " class="cart-thumb" alt="" /></a>
                                    <h6><a href="#">{{$products[$i]->name}}</a></h6>
                                    <p>{{$cart[$i]->amount}} x <span class="price">{{$products[$i]->price}} &euro;</span></p>
                                </li>
                            @endfor
                            <li class="total">
                                <a href="/cart" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                                <span class="float-right"><strong>Total</strong>: {{$totalPrice}} &euro;</span>
                            </li>
                        @else
                            <li><p>No products added to cart</p></li>
                        @endif
                    </ul>
                </li>
            </div>
        </nav>
        </header>

        <div class="top-search py-1"  style="background-color: rgb(250, 250, 250); border-top: 1px solid rgb(197, 197, 197);">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"  style="color: black"></i></span>
                    <form style="width: 97%" action="{{route('searchProducts')}}" method="get">
                        <input type="text" name="query" class="form-control" placeholder="Search" style="color: black">
                        <input type="submit" hidden>
                    </form>
                    <span class="input-group-addon close-search"><i class="fa fa-times"  style="color: black"></i></span>
                </div>
            </div>
        </div>
        <main >
            @include('inc.messages')
            @yield('content')
        </main>
    </div>

@section('extra-js')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/bootsnav.js') }}" defer></script>
<script src="{{ asset('js/costum.js') }}" defer></script>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" defer></script>
@show

</body>
@include('inc.footer')
</html>
