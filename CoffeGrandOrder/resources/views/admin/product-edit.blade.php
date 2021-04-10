@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Sửa sản phẩm')

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

<form action="{{route('product-update')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
  <div class="container">
    <input type="hidden" name="id" value="{{$product->id}}" />
	<label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter product name..." name="name" value="{{$product->name}}" required>

    <label for="description"><b>Description</b></label>
    <textarea type="text" placeholder="Enter product description..." name="description" rows="3" required>{{$product->description}}</textarea>

	<label for="stock"><b>Stock Status</b></label><br />
		<input type="radio" id="available" name="stock" @if ($product->stock == 1) checked @endif value="1">
		<label for="available">Available</label><br/>
		<input type="radio" id="unavailable" name="stock" @if ($product->stock == 0) checked @endif value="0">
		<label for="unavailable">Unavailable</label><br/>
	
	<label for="image"><b>Image</b></label>
    <input type="file" name="imagetoupload">
	
	<label for="price"><b>Price</b></label>
    <input type="number" placeholder="Enter price..." name="price" min="0" value="{{$product->price}}" required>
	
	<label for="type"><b>Type</b></label>
    <input type="text" placeholder="Enter product type..." name="type" value="{{$product->type}}" required>
	
    <button type="submit">Update Product</button>
    
  </div>

</form>

@endsection