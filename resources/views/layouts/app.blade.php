<!doctype html>
@if(app()->getLocale()=='ar')
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @else
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        @endif

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>ToFind</title>

            <!-- Favicons -->
            <link href="{{asset('img/favicon.png')}}" rel="icon">
            <link href="asset('img/apple-touch-icon.png')}}" rel="apple-touch-icon">

            <!-- Google Fonts -->
            <link
                href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
                rel="stylesheet">
            <link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">
            <!-- Bootstrap CSS File -->

            <link href="{{asset('js/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

            <!-- Libraries CSS Files -->
            <link href="{{ asset('js/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
            <link href="{{ asset('js/animate/animate.min.css') }}" rel="stylesheet">
            <link href="{{ asset('js/venobox/venobox.css') }}" rel="stylesheet">
            <link href="{{ asset('js/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

            <!-- Main Stylesheet File -->
            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{asset('css/reg_style.css')}}">

        </head>


        <body style="background: #f8f8f8;">
        <!--==========================
        Header
      ============================-->
        <header id="header">
            <div class="container">
                @if(app()->getLocale()=='ar')
                    <div id="logo" class="pull-left ">
                        <a href="/" class="scrollto"><img src="{{asset('img/logo.png') }}" alt="" title=""></a>
                    </div>

                    <nav id="nav-menu-container">
                        <ul class="nav-menu " style="float: right;">
                            <li style="float: right;"><a href="{{ url('locale/en') }}"><i class="fa fa-language"></i> EN</a>
                            </li>
                            <li style="float: right;"><a href="{{ url('locale/ar') }}"><i class="fa fa-language"></i> AR</a>
                            </li>
                            <li class=" {{ Request::is('/') ? 'menu-active' : '' }}" style="float: right;"><a
                                    href="/"> {{ __('messages.Home') }}</a></li>

                            <li class="dropdown {{ Request::is('people/search') ? 'menu-active' : '' }}"
                                style="float: right;">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('messages.Find People') }} </a>
                                <div class="dropdown-menu" style="background:rgba(110, 110, 110, 1);"
                                     aria-labelledby="navbarDropdown">
                                    <a class="{{ Request::is('people/search') ? 'menu-active' : '' }}"
                                       href="/people/search">{{ __('messages.All Lost People') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="lookfor"
                                       href="{{ url('people/search', 'lookfor')}}">{{ __('messages.Report For Missing Person') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="found"
                                       href="{{ url('people/search', 'found')}}">{{ __('messages.Report For Found Person') }}</a>
                                    <div class="divider"></div>
                                    <a class="" href="/people/image">{{ __('messages.search by image') }}</a>
                                </div>
                            </li>


                            <li class="dropdown {{ Request::is('items/search') ? 'menu-active' : '' }}"
                                style="float: right;">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('messages.Find Items') }}</a>
                                <div class="dropdown-menu" style="background:rgba(110, 110, 110, 1)"
                                     aria-labelledby="navbarDropdown">
                                    <a class=" {{ Request::is('items/search') ? 'menu-active' : '' }}"
                                       href="/items/search">{{ __('messages.All Found Items') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="found"
                                       href="{{ url('items/search', 'found')}}">{{ __('messages.Report For Found Item') }}</a>
                                </div>
                            </li>


                            <li class="{{ Request::is('about') ? 'menu-active' : '' }}" style="float: right;"><a
                                    href="/about"> {{ __('messages.about') }}</a></li>
                            <li class="{{ Request::is('contact') ? 'menu-active' : '' }}" style="float: right;"><a
                                    href="/contact"> {{ __('messages.Contact Us') }}</a></li>

                            @guest
                                <li class="buy-tickets " style="float: right;">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="buy-tickets" style="float: right;">
                                        <a class="nav-link"
                                           href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="buy-tickets dropdown pl-xl-5" style="float: right;">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-right mt-2"
                                         style="border: 0px;background:none;">
                                        <a class="dropdown-item d-block" href="/profile">
                                            {{ __('messages.MyProfile') }}
                                        </a>
                                        @role('Admin') <a class="dropdown-item d-block" href="/admin">
                                            {{ __('messages.Dashboard') }}
                                        </a>
                                        @endrole
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('messages.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                </li>

                            @endguest
                        </ul>
                    </nav><!-- #nav-menu-container -->
                    <div class="clearfix"></div>
                @else
                    <div id="logo" class="pull-left ">
                        <a href="/" class="scrollto"><img src="{{asset('img/logo.png') }}" alt="" title=""></a>
                    </div>

                    <nav id="nav-menu-container">
                        <ul class="nav-menu ">

                            <li class=" {{ Request::is('/') ? 'menu-active' : '' }}"><a
                                    href="/"> {{ __('messages.Home') }}</a></li>

                            <li class="dropdown {{ Request::is('people/search') ? 'menu-active' : '' }}">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('messages.Find People') }} </a>
                                <div class="dropdown-menu" style="background:rgba(110, 110, 110, 1);"
                                     aria-labelledby="navbarDropdown">
                                    <a class="{{ Request::is('people/search') ? 'menu-active' : '' }}"
                                       href="/people/search">{{ __('messages.All Lost People') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="lookfor"
                                       href="{{ url('people/search', 'lookfor')}}">{{ __('messages.Report For Missing Person') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="found"
                                       href="{{ url('people/search', 'found')}}">{{ __('messages.Report For Found Person') }}</a>
                                    <div class="divider"></div>
                                    <a class="" href="/people/image">{{ __('messages.search by image') }}</a>
                                </div>
                            </li>


                            <li class="dropdown {{ Request::is('items/search') ? 'menu-active' : '' }}">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('messages.Find Items') }}</a>
                                <div class="dropdown-menu" style="background:rgba(110, 110, 110, 1)"
                                     aria-labelledby="navbarDropdown">
                                    <a class=" {{ Request::is('items/search') ? 'menu-active' : '' }}"
                                       href="/items/search">{{ __('messages.All Found Items') }}</a>
                                    <div class="divider"></div>
                                    <a class="" value="found"
                                       href="{{ url('items/search', 'found')}}">{{ __('messages.Report For Found Item') }}</a>
                                </div>
                            </li>


                            <li class="{{ Request::is('about') ? 'menu-active' : '' }}"><a
                                    href="/about"> {{ __('messages.about') }}</a></li>
                            <li class="{{ Request::is('contact') ? 'menu-active' : '' }}"><a
                                    href="/contact"> {{ __('messages.Contact Us') }}</a></li>

                            @guest
                                <li class="buy-tickets ">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="buy-tickets">
                                        <a class="nav-link"
                                           href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="buy-tickets dropdown pl-xl-5">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-right mt-2"
                                         style="border: 0px;background:none;">
                                        <a class="dropdown-item d-block" href="/profile">
                                            {{-- {{ __('MyProfile') }}--}}
                                            {{ __('messages.MyProfile') }}
                                        </a>
                                        @role('Admin') <a class="dropdown-item d-block" href="/admin">
                                            {{ __('messages.Dashboard') }}
                                        </a>
                                        @endrole
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{-- {{ __('Logout') }}--}}
                                            {{ __('messages.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>

                                </li>

                            @endguest
                            <li class="ml-xl-5"><a href="{{ url('locale/en') }}"><i class="fa fa-language"></i> EN</a>
                            </li>
                            <li><a href="{{ url('locale/ar') }}"><i class="fa fa-language"></i> AR</a></li>
                        </ul>
                    </nav><!-- #nav-menu-container -->

                @endif
            </div>
        </header>
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
        <script src="{{ asset('js/main.js') }}"></script><!-- #header -->
        <script type="text/javascript">
            window.onhashchange = function () {
                if (window.innerDocClick) {
                    window.innerDocClick = false;
                } else {
                    if (window.location.hash != '#undefined') {
                        goBack();
                    } else {
                        history.pushState("", document.title, window.location.pathname);
                        location.reload();
                    }
                }
            }
        </script>


        <div>
            <!-- text-right -->
            @if(app()->getLocale()=='ar')
                <main class="wow fadeIn text-right">
                    @yield('content')

                </main>
            @else
                <main class="wow fadeIn">
                    @yield('content')

                </main>
            @endif
        </div>


        </body>

        </html>
