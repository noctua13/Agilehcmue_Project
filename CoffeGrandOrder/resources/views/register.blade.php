
<h1> Register </h1>
<br />
<br />
<!--check nếu có bất kì biến nào trong mảng array error -->

<form id="registerForm" action="register" method="POST" >

    @csrf
    <label for="username" >User Name</label><br/>
    <input type="text" id="usernameText" name="username" placeholder="blablabla" maxlength="10" value="{{session('username')}}"/><br/>
    <span style="color:red">@error('username'){{$message}}@enderror</span><br>
    
    <label for="password" >Password</label><br/>
    <input type="password" id="passwordText" name="password" placeholder="****" maxlength="10" /><br/>
    <span style="color:red">@error('password'){{$message}}@enderror</span><br>

    <label for="yourname" >Your Name</label><br/>
    <input type="text" id="yournameText" name="yourname" placeholder="Bla Bla" maxlength="10" value="{{session('name')}}" /><br/>
    <span style="color:red">@error('yourname'){{$message}}@enderror</span><br>

    <label for="email" >Email</label><br/>
    <input type="text" id="emailText" name="email" placeholder="blablabla@gmail.com" maxlength="50" value="{{session('email')}}" /><br/>
    <span style="color:red">@error('email'){{$message}}@enderror</span><br>

    <label for="phonenumber" >Phone Number</label><br/>
    <input type="text" id="phonenumberText" name="phonenumber" placeholder="09xxxxxxxx" maxlength="10" value="{{session('phonenumber')}}" /><br/>
    <span style="color:red">@error('phonenumber'){{$message}}@enderror</span><br>

    <input type="submit" value="Register" />
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#registerForm").validate({
            rules: {
                username: { required: true, minlength: 4},
                password: { required: true, minlength: 4},
                email: {
                    required: true,
                    email: true
                },
                yourname: {required: true, minlength: 3},
                phonenumber: {required: true, digits: true}
            },
            message:{
                username: {required: "Put your username/ID", minlength: "Your username/ID need longer than 4 chars"},
                password: {required: "Put your password", minlength: "Your password too short, longer than 4 chars pls"},
                email: {required: "Put your email", email: "This is not email, put/edit pls"},
                yourname: {required: "Put your name", minlength: "Your name too short, longer 3 chars pls"},
                phonenumber: {required: "Put your phonenumber pls", digits: "Only Digits chars pls"}
            },
            errorLabelContainer: "#myError",
            wrapper: "li",
            submitHandler: function (form) {
            if (confirm("Submit?    ")) {
                form.submit();
                }
            }
        });
    });
</script>

<style type="text/css">
label.error {
color: Red;
}
input.error {
background-color:#FFB6C1;
}
</style>