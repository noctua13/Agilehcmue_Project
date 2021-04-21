@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Trang Người Dùng')
@section('page-css')
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')

<h1>Welcome to Dashboard , here is your profile</h1>

<?php
$user = Auth::user()->username;
$name = Auth::user()->name;
$phone = Auth::user()->phone;
$email = Auth::user()->email;
$address = Auth::user()->address;
?>

<div class="container">    
  <div class="row">
    <div class="panel panel-default">
    <div class="panel-heading">  <h4 >User Profile</h4></div>
      <div class="panel-body">
    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
      <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
    </div>
                      
<div class="col-sm-9 r-layout-user">
        <div>
            <span class="text-lg text-bold pull-right"><a class="btn btn-info" href="/#"><i class="fa fa-eye"></i> View order history</a></span>
        </div>
        <div>
            <table class="table table-striped">
                <tr>
                    <td class="first-colmn">Username</td>
                    <?php echo "<td> $user </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Name</td>
                    <?php echo "<td> $name </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Email</td>
                    <?php echo "<td> $email </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">PhoneNumber</td>
                    <?php echo "<td> $phone </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Address</td>
                    <?php echo "<td> $address </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Job</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="first-colmn">Gender</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="first-colmn">Date of birth</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="first-colmn">Website</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="first-colmn">About</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    </div>
  </div>
</div>
<p>Bored already? <a class="btn btn-info" href="{{route('logout')}}">Log out</a>.</p>

@endsection

@section('page-js')
<link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script> 
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection