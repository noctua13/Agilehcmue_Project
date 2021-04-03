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
@foreach($products as $product)
              <div class="col-md-3 col-sm-6">
                <div class="product_wrap heading_space">
                  <div class="image">
                    <div class="tag">
                      <div class="tag">
                      <div class="tag-btn">
                        <span class="uppercase text-center">New</span>
                      </div>
                      </div>
                    </div>
                    <a class="fancybox" href="product/{{$product->slug}}.html">
                      <img src="product-images/{{$product->image}}" alt="Product" style="width: " class="img-responsive" />
                    </a>
                  </div>
                  <div class="product_desc">
                    <p class="title">{{$product->name}}</p>
                    <div class="list_content">
                      <h4 class="bottom30">{{$product->name}}</h4>
                        {!!$product->description!!}
                      <h4 class="price bottom30"><i class="fa fa-jpy"></i>{{$product->price}} &nbsp;<span class="discount"><i class="fa fa-jpy"></i>{{$product->price}}</span></h4>
                    </div>
                    <span class="price">{{$product->price}}đ</span>
                    <a class="fancybox" href="product/{{$product->id}}.html" data-fancybox-group="gallery"><i class="fa fa-shopping-bag open"></i></a>
                  </div>
                </div>
              </div>
              @endforeach
@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection

@section('content')



@endsection

@section('page-js')
@endsection