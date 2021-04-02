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
	@yield('page-css')
</head>
<body>
	<div class="wrapper">
		@include('layouts.header')
		@yield('content')
		@include('layouts.footer')
		<!-- REQUIRED JS -->
		<script src="js/jquery-2.2.3.js"></script>
		<script src="js/bootstrap4.min.js"></script>
		@yield('page-js')
	</div>
</body>
</html>