@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Sửa thông tin đơn hàng')

@section('page-css')

<style>
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password], input[type=number], input[type=file] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
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
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
</style>

@endsection

@section('content')

<form action="{{route('order-update')}}" method="POST">
{{ csrf_field() }}
  <div class="container">
    <input type="hidden" name="id" value="{{$order->id}}" />
	<label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter recipient's name..." name="name" value="{{$order->name}}" required>

	<label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter recipient's email..." name="email" value="{{$order->email}}" required>
	
	<label for="phone"><b>Phone number</b></label>
    <input type="text" placeholder="Enter recipient's phone number..." name="phone" value="{{$order->phone}}" required>

    <label for="delivery"><b>Delivery destination</b></label><br />
		<input type="radio" id="default" name="delivery" value="0" @if($order->deliverytype == 0) checked @endif>
		<label for="default">Pick up at the store</label><br/>
		@if (Auth::check())
		<input type="radio" id="address" name="delivery" value="1" @if($order->deliverytype == 1) checked @endif >
		<label for="address">At your address</label><br/>
		@endif
		<input type="radio" id="destination" name="delivery" value="2" @if ($order->deliverytype == 2) checked @endif>
		<label for="destination">At a destination</label><br/>
		
	<label for="address"><b>Address</b></label>
    <input type="text" placeholder="Enter delivery destination..." name="address" id="address-text" value="{{$order->address}}" required>

	
    <button type="submit">Update Order</button>
    
  </div>

</form>

@endsection

@section('page-js')
<script>
	$('#default').click(function() {
		$("#address-text").val("Store address");
	});
	@if (Auth::check())
	$('#address').click(function() {
		$("#address-text").val("{!! Auth::user()->address !!}");
	});	
	@endif
	$('#destination').click(function() {
		$("#address-text").val("");
	});
</script>
@endsection