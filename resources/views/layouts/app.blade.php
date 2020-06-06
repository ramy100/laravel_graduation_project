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
                        <a href="/" class="site-logo">
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
                                        <a href="{{ route('login') }}">Sign</a> In or 
                                        <div class="dropdown show">
                                          <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           Create Account
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="{{ route('register') }}" class="items">Register</a>
                                            <a href="{{ route('admin.create') }}" class="items">Register Admin</a>
                                            <a href="{{ route('user.create') }}" class="items">Register User</a>
                                            <a href="{{ route('company.create') }}" class="items">Register Company</a>
                                            <a href="{{ route('designer.create') }}" class="items">Register Designer</a>
                                          </div>
                                        </div>                                          
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
                                <span id="cart-count">{{ $cart_count }}</span>
                                </div>
                            <a href="{{ route('website.cart') }}">Shopping Cart</a>
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
                    <li><a href="/">Home</a></li>
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

    <!-- Footer section -->
    <section class="footer-section">
        <div class="container">
            <div class="footer-logo text-center">
                <a href="index.html"><img src="{{ asset('images/logo-light.png') }}" alt=""></a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>About</h2>
                        <p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
                        <img src="{{ asset('images/cards.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Track Orders</a></li>
                            <li><a href="">Returns</a></li>
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Shipping</a></li>
                            <li><a href="">Blog</a></li>
                        </ul>
                        <ul>
                            <li><a href="">Partners</a></li>
                            <li><a href="">Bloggers</a></li>
                            <li><a href="">Support</a></li>
                            <li><a href="">Terms of Use</a></li>
                            <li><a href="">Press</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <div class="fw-latest-post-widget">
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="{{ asset('images/blog-thumbs/1.jpg') }}"></div>
                                <div class="lp-content">
                                    <h6>what shoes to wear</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="{{ asset('images/blog-thumbs/2.jpg') }}"></div>
                                <div class="lp-content">
                                    <h6>trends this year</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget contact-widget">
                        <h2>Questions</h2>
                        <div class="con-info">
                            <span>C.</span>
                            <p>Your Company Ltd </p>
                        </div>
                        <div class="con-info">
                            <span>B.</span>
                            <p>1481 Creekside Lane  Avila Beach, CA 93424, P.O. BOX 68 </p>
                        </div>
                        <div class="con-info">
                            <span>T.</span>
                            <p>+53 345 7953 32453</p>
                        </div>
                        <div class="con-info">
                            <span>E.</span>
                            <p>office@youremail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container">
                <div class="social-links">
                    <a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
                    <a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
                    <a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
                    <a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
                    <a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
                    <a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
                    <a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
                </div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> 
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </div>
        </div>
    </section>
    <!-- Footer section end -->



    </div>

   
    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

     

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    


<script>
    $(document).ready(function(){

        $(document).on('click', '.add-card', function(){
            var design_id = $(this).data('id');
            $.post('{{ route('add-to-cart') }}', {"_token": "{{ csrf_token() }}","id": design_id}, function(response){
				
                if(response.status == '1'){

                    $(document).find('#cart-count').html(response.count);
                    
                }
                    alert(response.msg);
            }).fail(function(error){

            })

        })

    });
</script>


     @stack('scripts')

</body>
</html>
