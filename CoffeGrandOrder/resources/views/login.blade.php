@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Đăng nhập')
@section('page-css')

<style>
/* Source: https://www.w3schools.com/howto/howto_css_signup_form.asp */

/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}
</style>
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/login.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')

<!-- <form method="POST" action="{{route('user-authenticate')}}">
	{{ csrf_field() }}
	<div class="container">
		<label for="username"><b>Username</b></label>
		<input type="text" placeholder="Enter Username..." name="username" required>
		
		<label for="password"><b>Password</b></label>
		<input type="password" placeholder="Enter Password..." name="password" required>
		
		<div class="clearfix">
		<button type="submit" class="signupbtn">Log in</button>
    </div>
	
	</div>
</form> -->

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div >
                <form class="box" method="POST" action="{{route('user-authenticate')}}" >
                {{ csrf_field() }}
                    <h1>Login</h1>
                    <p class="text-muted"> Please enter your username and password!</p>
                    <input type="text" placeholder="Enter Username..." name="username" required>
                    <input type="password" placeholder="Enter Password..." name="password" required>
                      <a class="forgot text-muted" href="#">Forgot password?</a>
                     <input type="submit" name="" value="Login" href="#">
                     <a class="forgot text-muted" href="{{route('signup')}}">I don't have account.</a>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script type="text/javascript" src="./js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="./js/templatemo-script.js"></script> 
   <link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
@endsection