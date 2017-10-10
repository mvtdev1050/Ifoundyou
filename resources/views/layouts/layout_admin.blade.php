<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
<!-- 	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
 -->	<title>@yield('title')</title>
	
	<link rel="stylesheet" href="{{ asset('public/assets/libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css') }}">
	<!-- build:css ../assets/css/app.min.css -->
	<link rel="stylesheet" href="{{ asset('public/assets/libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/libs/bower/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/libs/bower/perfect-scrollbar/css/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
	<script src="{{ asset('assets/js/jquery-3.2.0.js') }}" type="text/javascript"></script>
	<style type="text/css">
	.form-control
	{
		color: #707070 !important;
	}
	.has-success .form-control{
		border-color: #2b542c !important;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #67b168 !important;
	}
	.has-error .form-control{
		 border-color: #843534 !important;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483 !important;
	}
	.has-success .control-label{ font-weight: 700}
	[class^="fa-"], [class^="glyphicon-"], [class^="icon-"], [class*=" fa-"], [class*=" glyphicon-"], [class*=" icon-"]{ line-height: 34px !important;}
	.navbar-minimalize{padding: 0 12px !important;margin: 10px 0 10px 20px;}
	.dropdown-menu > li > a
	{
		padding: 1px 16px;
	}
</style>
	@yield('css')
	<!-- endbuild -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="{{ asset('public/assets/libs/bower/breakpoints.js/dist/breakpoints.min.js') }}"></script>
	<script>
		Breakpoints();
	</script>
	<!-- build:js ../assets/js/core.min.js -->
	<script src="{{ asset('public/assets/libs/bower/jquery/dist/jquery.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/PACE/pace.min.js') }}"></script>
	@yield('script')
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">

	@yield('content')
	<link rel="stylesheet" href="http://formvalidation.io/vendor/formvalidation/css/formValidation.min.css">
    <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
	<script src="{{ asset('public/assets/js/library.js') }}"></script>
	<script src="{{ asset('public/assets/js/plugins.js') }}"></script>
	<script src="{{ asset('public/assets/js/app.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/moment/moment.js') }}"></script>
	<script src="{{ asset('public/assets/libs/bower/fullcalendar/dist/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/fullcalendar.js') }}"></script>
</body>
</html>