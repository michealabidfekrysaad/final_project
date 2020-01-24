<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->

    <link href="{{asset('js/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('js/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>


<body>
    <!--==========================
    Header
  ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <!-- Uncomment below if you prefer to use a text logo -->
                <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
                <a href="/" class="scrollto"><img src="{{asset('img/logo.png') }}" alt="" title=""></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu ">
                    <li class=" {{ Request::is('/') ? 'menu-active' : '' }}"><a href="/">Home</a></li>
                    
                    <li class="dropdown {{ Request::is('people/search') ? 'menu-active' : '' }}">
                        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Find People                        </a>
                        <div class="dropdown-menu" style="background-color: #f82249" aria-labelledby="navbarDropdown">
                          <a class=" {{ Request::is('people/search') ? 'menu-active' : '' }}" href="/people/search">All People</a>
                          <div class="divider"></div>
                          <a class="" href="/people/missing">Search for missing</a>
                          <div class="divider"></div>
                          <a class="" href="#">found a missing</a>
                          <div class="divider"></div>
                          <a class="" href="#">search by image</a>
                        </div>
                      </li>


                    <li class=""><a href="#about">Find Items</a></li>
                    <li class=""><a href="#about">About</a></li>
                    <li class="{{ Request::is('contact') ? 'menu-active' : '' }}"><a href="/contact">Contact Us</a></li>

                    @guest
                    <li class="buy-tickets pl-xl-5">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="buy-tickets">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="buy-tickets dropdown ml-xl-5 pl-xl-5">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="border: 0px;background:none;">
                            <a class="dropdown-item d-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
    <div>
        <main>
            @yield('content')
            
        </main>
    </div>
 
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/easing/easing.min.js') }}"></script>
    <script src="{{ asset('js/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('js/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('js/wow/wow.min.js') }}"></script>
    <script src="{{ asset('js/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('js/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Form JavaScript File -->
    <script src="{{ asset('js/contactform/contactform.js') }}"></script>

    <!-- Template Main Javascript File -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>