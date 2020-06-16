<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>MY DESIGN</title>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- login    --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    {{-- end of login --}}
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <style type="text/css">
        #Notifications::after {
            content: none;
        }
        .hideNotification{
            display: none;
        }
    </style>

    <script type="text/javascript">
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>
     @if(!auth()->guest())
        <script>
            window.Laravel.userId = <?php echo auth()->user()->id; ?>
        </script>
    @endif
    @yield('styles')


</head>
<body>
    <div id="app">
        @auth
            @if (Auth::user()->email_verified_at === null)
            <div class="alert alert-success" role="alert">
                <strong>Your email is not verified yet please check your email</strong>
            </div>
            @endif
        @endauth
        <!-- Header section -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 text-center text-lg-left">
                        <!-- logo -->
                        <a href="/" class="site-logo">
                            <img src="{{ asset('images/myDesign.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <form class="header-search-form" method="GET" action="{{ route('search') }}">
                            <input type="text" placeholder="Search by Tag or Category ...." name="word">
                            <button><i class="flaticon-search"></i></button>
                        </form>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="user-panel">
                            @auth
                                <div class="up-item notifications" onclick="MarkAsRead()">
                                        <a id="Notifications" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > <i class="fa fa-globe" aria-hidden="true"></i>
                                        </a>
                                        <input type="hidden" name="count" id="count" value="{{Auth::user()->unreadNotifications->count() }}" >

                                        <span id="Notification-count" class="{{ (Auth::user()->unreadNotifications->count()  <= 0) ? ' hideNotification': '' }} ">{{ Auth::user()->unreadNotifications->count() }}</span>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Notifications" id="notificationList">
                                            @forelse (Auth::user()->unreadNotifications as $notification)
                                            <a class="dropdown-item" href="{{ route('design.show',['design'=>$notification->data['design']['id']]) }}">
                                              {{$notification->data['company']}} has bought your {{ $notification->data['design']['title'] }} design
                                            </a>
                                            @empty
                                                <p>No unread notifications</p>
                                            @endforelse

                                        </div>
                                </div>
                                @if( $user->role == "designer")
                                <div style="display: inline;margin-right: 20px;"> 
                                <a href="{{ route('designer.show',['designer'=>$user->id]) }}" style="color: black;"> Profile</a>
                                </div>
                                @elseif($user->role == "company")
                                <div style="display: inline;margin-right: 20px;"> 
                                <a href="{{ route('company.show',['company'=>$user->id]) }}" style="color: black;"> Profile</a>
                                </div>
                                @elseif( $user->role == "user")
                                <div style="display: inline;margin-right: 20px;"> 
                                    <a href="{{ route('user.show',['user'=>$user->id]) }}" style="color: black;"> Profile</a>
                                </div>
                                
                                @endif
                            @endauth
                            @guest
                                <div class="up-item">
                                    <i class="flaticon-profile"></i>
                                    @if (Route::has('register'))
                                        <a href="{{ route('login') }}">Sign</a> In or
                                        <a href="{{ route('createAccount') }}">Create Account</a> 
                                       {{-- <div class="dropdown show">
                                          <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           Create Account
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="{{ route('register') }}" class="items">Register</a>
                                            <a href="{{ route('registeration.form','admin') }}" class="items">Register Admin</a>
                                            <a href="{{ route('registeration.form','user') }}" class="items">Register User</a>
                                            <a href="{{ route('registeration.form','company') }}" class="items">Register Company</a>
                                            <a href="{{ route('registeration.form','designer') }}" class="items">Register Designer</a>
                                          </div>
                                        </div>  --}}                                        
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
                            @if ($user_role == 'company')                                
                                <div class="up-item">
                                    <div class="shopping-card">
                                        <i class="flaticon-bag"></i>
                                    <span id="cart-count">{{ $cart_count }}</span>
                                    </div>
                                    <a href="{{ route('website.cart') }}">Shopping Cart</a>
                                </div>
                            @endif
                            
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
                    <li><a href="{{ route('designer.index')}}">Designers</a></li>
                    <li><a href="{{ route('design.index')}}">Designs</a></li>
                    <li><a href="{{route('company.index')}}">Companies</a></li>
                    <li><a href="#">Categories</a>
                        <ul class="sub-menu">
                            <li><a href="/design/category/women">Women</a></li>
                            <li><a href="/design/category/men">Men</a></li>
                            <li><a href="/design/category/kids">Kids</a></li>
                            <li><a href="/design/category/teenagers">Teenagers</a></li>
                        </ul>
                    </li>
                    <li><a href="#">How it works</a></li>
                   <!--  <li><a href="#">Shoes</a>
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
                    <li><a href="#">Blog</a></li> -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Header section end -->

    @yield('content')

    <!-- Footer section -->
    <section class="footer-section">
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
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
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
        function MarkAsRead()
            {
                console.log("hi");
                count=$('#count').val();
                if(count>0)
                {
                    console.log("click");
                     $.get('/notification/MarkAsRead', function(data, status){
                        // alert("Data: " + data + "\nStatus: " + status);
                        $('#Notification-count').html(0);
                         $('#Notification-count').addClass("hideNotification");
   
                      }) ;
                }
            }

        $(document).ready(function(){
            console.log(Laravel.userId);
                if(Laravel.userId) {
                window.Echo.private(`App.User.${Laravel.userId}`)
                .notification((notification) => {
                   alert("notification");
                   count=$('#Notification-count').html();
                   count=parseInt(count)+1;
                   console.log(count);
                   $('#Notification-count').html(count);
                   $('#count').val(count);
                   console.log($('#count').val());
                    $('#Notification-count').removeClass("hideNotification");
                   $('#notificationList').append(`
                    <a class="dropdown-item" href="#">
                                              ${notification['company']} has bought your ${notification['design']['title']} design
                                            </a>
                    `);
                   console.log(notification);
                });
            }
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
