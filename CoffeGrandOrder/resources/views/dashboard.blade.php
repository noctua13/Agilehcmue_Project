@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Trang Người Dùng')
@section('page-css')
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')

<h1>Welcome to Dashboard , profile customer is here</h1>

<p>Bored already? <a href="{{route('logout')}}">Log out</a>.</p>
<?php
$user = Auth::user();
echo $user;
?>
@endsection

@section('page-js')
<link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script> 
@endsection