<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
<!-- 	<link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
 -->	
	<link rel="stylesheet" href="{{ asset('assets/libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="http://formvalidation.io/vendor/formvalidation/css/formValidation.min.css">
	<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/misc-pages.css') }}">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	<script src="http://brc.devserver.co.in/admin/js/jquery-2.1.1.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
    <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
    <script src="http://brc.devserver.co.in/admin/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="http://brc.devserver.co.in/admin/js/bootstrap.min.js"></script>
	@yield('script')
</head>
<body class="simple-page">
	 @yield('content')
</body>
</html>