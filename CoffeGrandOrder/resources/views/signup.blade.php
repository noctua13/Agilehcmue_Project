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
.error{
  color:red;
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
@endsection

@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div >
                <form id="registerBox" class="box" method="POST" action="{{route('user-store')}}">
                {{ csrf_field() }}
                    <h1>Register</h1>
                    
		
      <input type="text" placeholder="Enter Username..." name="username" required>
      @error('username')
      <span style="color:red">{{$message}}</span><br>
      @enderror
      
      <input type="password" placeholder="Enter Password..." name="password" required>
      @error('password')
      <span style="color:red">{{$message}}</span><br>
      @enderror
      
      <input type="text" placeholder="Enter Your Name..." name="name" required>
      @error('name')
      <span style="color:red">{{$message}}</span><br>
      @enderror
      
      <input type="text" placeholder="Enter Your Address..." name="address" required>
      
      
      <input type="text" placeholder="Enter Your Phone Number..." name="phone" required>
      @error('phone')
      <span style="color:red">{{$message}}</span><br>
      @enderror
      
      <input type="text" placeholder="Enter Your Email..." name="email" required>
      @error('email')
      <span style="color:red">{{$message}}</span><br>
      @enderror
      
      <input type="submit" value="Sign up" href="#">
    <a class="forgot text-muted" href="{{route('login')}}">I Have an account.</a>
    
   
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#registerBox").validate({
            rules: {
                username: { required: true, minlength: 4},
                password: { required: true, minlength: 4},
                email: {
                    required: true,
                    email: true
                },
                name: {required: true, minlength: 3},
                phone: {required: true, digits: true}
            },
            message:{
                username: {required: "Put your username/ID", minlength: "Your username/ID too short"},
                password: {required: "Put your password", minlength: "Your password too short"},
                email: {required: "Put your email", email: "This is not email"},
                name: {required: "Put your name", minlength: "Your name too short"},
                phone: {required: "Put your phonenumber pls", digits: "Only Digits chars"}
            },
            errorLabelContainer: "#myError",
            wrapper: "p",
            submitHandler: function (form) {
            if (confirm("Submit?    ")) {
                form.submit();
                }
            }
        });
    });
</script>
@endsection