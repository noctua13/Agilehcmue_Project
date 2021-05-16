<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="TamAndTheBois" name="author">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@yield('meta-og-system')
	<base href="{{asset('')}}">
	<!-- REQUIRED CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	@yield('page-css')
	
	<!-- Cafe House Template
		http://www.templatemo.com/tm-466-cafe-house
	-->
</head>
<body>
	<div class="wrapper">
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
		<!-- REQUIRED JS -->
		<script src="js/jquery-2.2.3.js"></script>
		
		<link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">	
		
		<script src="js/bootstrap4.min.js"></script>
		<script type="text/javascript" src="js/templatemo-script.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		@yield('page-js')
		
	</div>
</body>
</html>