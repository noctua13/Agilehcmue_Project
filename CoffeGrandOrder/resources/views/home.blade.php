@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Trang chủ')
@section('page-css')
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/home.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')
<p>Don't have an account yet? <a href="signup.html"> Sign Up </a> now</p>
<p>Already have an account? <a href="login.html"> Log in</a></p>
@endsection

@section('page-js')
@endsection