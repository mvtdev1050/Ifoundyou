<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/css/formValidation.css') }}">
    <script src="{{ URL::asset('assets/js/jquery-3.2.0.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/formValidation.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/framework.bootstrap.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/magnific-popup.css') }}">
    <script src="{{ URL::asset('assets/js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
    
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iFoundu') }}</title>

    <!-- Styles -->
  

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @if(Auth::check())
    <script type="text/javascript">
        jQuery(document).ready(function(){
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { jQuery('body').addClass('safari'); }
            function getNotification() {
                jQuery.ajax({
                    type:'GET',
                    url:'/admin/getNotification',
                    success:function(data){
                        var abc =  JSON.parse(data);
                        if(abc.notify == 0) {
                            jQuery('.notification_icon, .notify').hide();
                        } else {
                           jQuery('.notification_icon, .notify').show();
                           jQuery('.notification_icon, .notify').text(abc.notify);
                        }
                       if(abc.frnd_notify == 0) {
                            jQuery('.frnd_notify').hide();
                        } else {
                            jQuery('.frnd_notify').show();
                            jQuery('.frnd_notify').text(abc.frnd_notify);
                        }
                        if(abc.bookmark_notify == 0) {
                            jQuery('.bookmark_notify').hide();
                        } else {
                            jQuery('.bookmark_notify').show();
                            jQuery('.bookmark_notify').text(abc.bookmark_notify);
                        }
                        if(abc.msg_notify == 0) {
                            jQuery('.msg_notify, .message_icon').hide();
                        } else {
                            jQuery('.msg_notify, .message_icon').show();
                            jQuery('.msg_notify, .message_icon').text(abc.msg_notify);
                        }
                        //$("#msg").html(data.msg);
                    }
                });
            }
        setInterval(getNotification, 1000);
        });
    </script>
    @endif
</head>
<body>
    <div id="app">
        <div class="header-bar @if (!Auth::guest()) no-guest @endif">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container-high desktop">
                    <div class="left-header">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/Untitled-1.jpg') }}"/></a>
                    </div>
                    <div class="right-header">
                        <div class="navbar-header">
                            <!-- Collapsed Hamburger -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse-desktop">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <!-- Branding Image -->
                            <!-- @if (!Auth::guest())
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'iFoundu') }}
                            </a>
                            @endif -->
                        </div>

                        <div class="collapse navbar-collapse main-menuu" id="app-navbar-collapse-desktop">
                            <!-- Left Side Of Navbar -->
                           <!--  <ul class="nav navbar-nav">
                               &nbsp;
                           </ul> -->

                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                    <li class=""><a href="{{ route('login') }}">Login</a></li>
                                    <li class=""><a href="{{ route('register') }}">Register</a></li>
                                @else
                                    <li class="left-links">
                                        <div class="menu">
                                         <?php $data       =  (new \App\PageCms)->Allpages(); ?>
                                         <?php $dataHeader =  (new \App\PageCms)->Allpagesheader(); ?>
                                         <?php $datafooter =  (new \App\PageCms)->AllpagesFooter(); ?>

                                            <ul>
                                               <li><a href="/">Home</a></li>
                                               @if(!empty($dataHeader))
                                                @foreach($dataHeader as $value) 
                                                  <li><a href="/page/{{ $value->slug }}">{{ $value->title }}</a></li>
                                                @endforeach
                                               @endif
                                                <li class="active"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
                                                {{-- <li><a href="#">Home</a></li>
                                                <li><a href="#">About ifoundyou</a></li>
                                                <li><a href="#">What is i found you</a></li>
                                                <li><a href="#">Search is i found you</a></li> --}}
                                                
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown right-links">
                                        <ul class="notification">
                                               <li><i class="fa fa-bell" aria-hidden="true"></i><span class="notification_icon" style="display: none;"></span></li>
                                               <li><i class="fa fa-envelope" aria-hidden="true"><span class="message_icon" style="display: none;"></span></i></li>
                                               <li class="profile-name"><div class="image-small"><img src="@if(Auth::user()->profile_image != NULL) 
                                               {{ asset('/public/assets/images/users/')}}/{{ Auth::user()->profile_image }} @else
                                               {{ asset('/public/assets/images/users/dummymale.jpg')}}
                                               @endif" width= "40px" height="40px;";/></div>  <span>{{ Auth::user()->username }}</span></li>
                                        </ul>
                                        <a href="#" class="dropdown-toggle login-name settings" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                           
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
                    
                </div>
                <div class="container-high mobile" style="display: none;">
                    
                        <div class="navbar-header">

                            <div class="mobile-logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo_lg.jpg') }}"/></a>
                            </div>  
                            <!-- Collapsed Hamburger -->

                            

                            <!-- Branding Image -->
                            <!-- @if (!Auth::guest())
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'iFoundu') }}
                            </a>
                            @endif -->
                        </div>
                        <div class="mobile-noti">
                            @if (!Auth::guest())
                            <ul class="notification">
                               <li><i class="fa fa-bell" aria-hidden="true"></i><span class="notification_icon"></span></li>
                               <li><i class="fa fa-envelope" aria-hidden="true"><span class="message_icon"></span></i></li>
                               <li class="profile-name"><div class="image-small"><img src="{{ asset('assets/images/pro.jpg') }}" width= "40px" height="40px;";/></div>  <span>Charlse Pisano</span></li>
                            </ul>
                            @endif
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Left Side Of Navbar -->
                           <!--  <ul class="nav navbar-nav">
                               &nbsp;
                           </ul> -->

                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @else
                                    
                                    <li><a href="/">Home</a></li>
                                    @if(!empty($dataHeader))
                                        @foreach($dataHeader as $value) 
                                        <li><a href="{{ $value->slug }}">{{ $value->title }}</a></li>
                                        @endforeach
                                    @endif
                                    <li class="active"><a href="{{ url('/dashboard')}}">Dashboard</a></li>
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
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </nav>
        </div>

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
        <p>Ifoundyou © 2017. All Rights Reserved.</p>
    </div>

    <!-- Scripts -->

</body>
</html>
