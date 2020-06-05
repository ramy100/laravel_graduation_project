<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>

</head>
<body>
    <div id="app">
        <!-- Header section -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 text-center text-lg-left">
                        <!-- logo -->
                        <a href="./index.html" class="site-logo">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <form class="header-search-form">
                            <input type="text" placeholder="Search on divisima ....">
                            <button><i class="flaticon-search"></i></button>
                        </form>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="user-panel">
                            @guest
                                <div class="up-item">
                                    <i class="flaticon-profile"></i>
                                    @if (Route::has('register'))
                                        <a href="{{ route('login') }}">Sign</a> In or <a href="{{ route('register') }}">Create Account</a>
                                    @endif
                                </div>
                            @else
                                <div class="up-item">
                                    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                            <div class="up-item">
                                <div class="shopping-card">
                                    <i class="flaticon-bag"></i>
                                    <span>0</span>
                                </div>
                                <a href="#">Shopping Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="main-navbar">
            <div class="container">
                <!-- menu -->
                <ul class="main-menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Jewelry
                        <span class="new">New</span>
                    </a></li>
                    <li><a href="#">Shoes</a>
                        <ul class="sub-menu">
                            <li><a href="#">Sneakers</a></li>
                            <li><a href="#">Sandals</a></li>
                            <li><a href="#">Formal Shoes</a></li>
                            <li><a href="#">Boots</a></li>
                            <li><a href="#">Flip Flops</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="./product.html">Product Page</a></li>
                            <li><a href="./category.html">Category Page</a></li>
                            <li><a href="./cart.html">Cart Page</a></li>
                            <li><a href="./checkout.html">Checkout Page</a></li>
                            <li><a href="./contact.html">Contact Page</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Header section end -->

    @yield('content')

    </div>


    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    

</body>
</html>
