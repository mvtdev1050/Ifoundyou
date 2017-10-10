<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <script src="{{ URL::asset('assets/js/jquery-3.2.0.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/script.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap-datepicker.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iFoundu') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="home-page">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="main-home-bar">
                <div class="navbar-header">
                    
                   <?php $dataHeader =  (new \App\PageCms)->Allpagesheader(); ?>
                   <?php $datafooter =  (new \App\PageCms)->AllpagesFooter(); ?>
                   <?php $footersettings =  (new \App\Setting)->Footersetting(); ?>
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <!-- <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'iFoundu') }}
                    </a> -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle home-drop" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <div class="image-small">
                                        @if(Auth::user()->profile_image == '') 
                                            <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}" width= "40px" height="40px"/>
                                        @else 
                                        <img src="{{ asset('public/assets/images/users/'.Auth::user()->profile_image) }}" width= "40px" height="40px"/>
                                        @endif
                                        <!-- <img src="{{ asset('assets/images/pro-lg.jpg') }}" width= "40px" height="40px;";/> -->
                                    </div>{{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                   <li>
                                    <a href="{{ url('/dashboard')}}">Dashboard</a>
                                </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <div class="search_footer">
        <ul class="footer_menu"> 
        @if(!empty($datafooter))
            @foreach($datafooter as $value) 
                <li><a href="/page/{{ $value->slug }}">{{ $value->title }}</a></li>
            @endforeach 
         @endif   
            {{-- <li><a href="" >About Ifoundyou</a></li>
            <li><a href="" >Contact Us</a></li>
            <li><a href="" >Terms of Service</a></li>
            <li><a href="" >User Agreement</a></li> --}}
        </ul> 
        <p><?php print_r($footersettings->footer_setting); ?></p>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
</body>
</html>
