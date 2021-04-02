@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Đăng ký')
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
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')

<form method="POST" action="{{route('user-store')}}">
	{{ csrf_field() }}
	<div class="container">
		<label for="username"><b>Username</b></label>
		<input type="text" placeholder="Enter Username..." name="username" required>
		
		<label for="password"><b>Password</b></label>
		<input type="password" placeholder="Enter Password..." name="password" required>
		
		<label for="name"><b>Name</b></label>
		<input type="text" placeholder="Enter Your Name..." name="name" required>
		
		<label for="address"><b>Address</b></label>
		<input type="text" placeholder="Enter Your Address..." name="address" required>
		
		<label for="phone"><b>Phone</b></label>
		<input type="text" placeholder="Enter Your Phone Number..." name="phone" required>
		
		<label for="email"><b>Email</b></label>
		<input type="text" placeholder="Enter Your Email..." name="email" required>
		
		<p>By creating an account you agree to TâmGankTeam's <a href="#">Terms & Privacy</a>.</p>
		<div class="clearfix">
		<button type="submit" class="signupbtn">Sign Up</button>
    </div>
	
	</div>
</form>

@endsection

@section('page-js')
@endsection