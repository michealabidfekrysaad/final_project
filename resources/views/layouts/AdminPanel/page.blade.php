<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ToFind</title>
    <link href="{{ asset('admin_css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css" rel="stylesheet') }}" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_css/theme.css') }}" rel="stylesheet" media="all">

</head>


<body class="animsition" style="animation-duration: 900ms; opacity: 3;">
    <div class="page-wrapper">

        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
{{--                            <img src="images/icon/logo.png" alt="">--}}
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <li>
                        any thing
                    </li>

                    </ul>
                </div>
            </nav>
        </header>
    <aside class="menu-sidebar d-none d-lg-block">

        <div class="logo">
            <a href="/admin/panel">

                Dashboard
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">

                            <li>
                                <a href="/admin/panel/userstable">
                                    <i class="fas fa-table"></i>Users Management</a>
                            </li>
                            <li>
                                <a href="/items/index"> <i class="fas fa-table"></i>Items Management</a>
                            </li>
                            <li>
                                <a href="/admin/panel/report"> <i class="fas fa-table"></i>Reports Management</a>
                            </li>
                            <li>
                                <a href="/category/admin"> <i class="fas fa-table"></i>
                                    Category Management</a>
                            </li>

                    <li>
                        <a href=" /attribute/admin"> <i class="fas fa-table"></i>
                            Attribute Management</a>
                    </li>

                    <li>
                        <a href="map.html">
                            <i class="fas fa-map-marker-alt"></i>Maps</a>
                    </li>
                    <li>
                        <a href="/charts">
                            <i class="fas fa-map-marker-alt"></i>Charts </a>
                    </li>
                        </ul>

            </nav>
        </div>
    </aside>


    <div class="page-container">
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    <div class="header-button  ml-auto">
                        <div class="noti-wrap ">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-comment-more"></i>
                                <span class="quantity">{{count($lastMessages)}}</span>
                                <div class="mess-dropdown js-dropdown">
                                    <div class="mess__title">
                                        <p>You have {{count($lastMessages)}} news message</p>
                                    </div>
                                    <div class="mess__item">
                                        <div class="content">

                                            @foreach($lastMessages as $lastmessage)
                                                <h6>{{$lastmessage->name}}</h6>
                                                <P>{{$lastmessage->subject}}}</P>
                                                <hr>
                                                @endforeach
                                        </div>
                                    </div>

                                    <div class="mess__footer">
                                        <a href="/allmessages">View all messages</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image mt-2">
                                    <img class="rounded-circle" src="{{ asset('img/download.png') }}" alt="{{auth()->user()->name}}">
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{auth()->user()->name}}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('img/download.png') }}" alt="{{auth()->user()->name}}">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{auth()->user()->name}}</a>
                                            </h5>
                                            <span class="email">{{auth()->user()->email}}</span>
                                        </div>
                                    </div>

                                    <div class="account-dropdown__footer">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{--                                {{ __('Logout') }}--}}
                                            {{ __('messages.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}">
    </script>
    <!-- Main JS-->
    <script src="{{ asset('admin_js/main.js') }}"></script>
    <div class="main-content">
        <main>
            @yield('content')

        </main>
    </div>
    </div>



    </div>




</body>

</html>

