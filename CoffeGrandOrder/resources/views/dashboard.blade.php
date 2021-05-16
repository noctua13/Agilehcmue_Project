@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Trang Người Dùng')
@section('page-css')
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <style type="text/css">
    .textlg{
      padding: 10px;
    }
  </style>
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')


<?php
$user = Auth::user()->username;
$name = Auth::user()->name;
$phone = Auth::user()->phone;
$email = Auth::user()->email;
$address = Auth::user()->address;
?>

<div class="container" >    
  <div class="row" >
    <div class="panel panel-default"  >
    <div class="panel-heading">  <h4 >User Profile</h4></div>
      <div class="panel-body">
    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
      <img alt="User Pic" style="width:50%; height: 50%" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
    </div>
                      
<div class="col-sm-12 r-layout-user" >
        <div>
        

            <span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-info" href="/order-history/{{Auth::user()->id}}.html"><i class="fa fa-eye"></i> View Order History</a></span>
               <span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-danger" href="{{route('logout')}}">Log out</a></span>
			@if (Auth::user()->permission == 1)
			<span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-success" href="/product-list.html"><i class="fa fa-eye"></i> Product Management</a></span>
      <span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-success" href="/analize.html"><i class="fa fa-eye"></i> Analize</a></span>
			<span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-primary" href="/order-history.html"><i class="fa fa-eye"></i> Order Management</a></span>		
			<span class="text-lg text-bold pull-right" style="padding: 10px"><a class="btn btn-danger" href="/user-list.html"><i class="fa fa-eye"></i> User Management</a></span>
			@endif
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
                    <td class="first-colmn">Phone Number</td>
                    <?php echo "<td> $phone </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Address</td>
                    <?php echo "<td> $address </td>" ?>
                </tr>
                <tr>
                    <td class="first-colmn">Verified</td>
                    <td>
						@if (Auth::user()->isverified == 1)
							Yes
						@else
							No
						@endif
					</td>
                </tr>
                <tr>
                    <td class="first-colmn">Permission</td>
                    <td>
						@if (Auth::user()->permission == 1)
							Administrator
						@else
							Customer
						@endif
					</td>
                </tr>
                <tr>
                    <td class="first-colmn">Date of birth</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    </div>
  </div>
</div>

@endsection

@section('page-js')
<link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script> 
   <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection