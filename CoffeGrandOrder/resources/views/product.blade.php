@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Sản phẩm')
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
<link href="{{ asset('/css/detailproduct.css') }}" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
<div class="card">
	<div class="row">
		<aside class="col-sm-7 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div> <a href="#"><img src="product-images/{!!$product->image!!}"></a></div>
</div> <!-- slider-product.// -->
<div class="img-small-wrap">
  <div class="item-gallery"> <img src="product-images/{!!$product->image!!}"> </div>
  <div class="item-gallery"> <img src="product-images/{!!$product->image!!}"> </div>
  <div class="item-gallery"> <img src="product-images/{!!$product->image!!}"> </div>
  <div class="item-gallery"> <img src="product-images/{!!$product->image!!}"> </div>
</div> <!-- slider-nav.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>

		<aside class="col-sm-5">
<article class="card-body p-5">
	<h3 class="title mb-3">{!!$product->name!!}</h3>

<p class="price-detail-wrap"> 
	<span class="price h3 text-warning"> 
		<span class="currency">Price: </span><span class="num">$ {!!$product->price!!}</span>
	</span> 

</p> <!-- price-detail-wrap .// -->
<dl class="item-property">
  <dt>Description</dt>
  <dd><p>{!!$product->description!!}</p></dd>
</dl>
<dl class="param param-feature">
  <dt>Drink</dt>
  <dd>{{$product->type}}</dd>
</dl>  <!-- item-property-hor .// -->

<!--<dl class="param param-feature">
  <dt>Delivery</dt>
  <dd>Russia, USA, and Europe</dd>
</dl>   item-property-hor .//
 -->
<form action="/cart/insert" method="get">
<input type="hidden" name="id" value="{{$product->id}}" />
<hr>
	<div class="row">
		<div class="col-sm-5">
			<dl class="param param-inline">
			  <dt>Quantity: </dt>
			  <dd>
			  	<input type="number" min="1" style="width:50%; text-align: center;" name="quantity" value="1" />
			  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
		<div class="col-sm-7">
			<dl class="param param-inline">
				  <dt>Size: </dt>
				  <dd>
				  	<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="size" id="inlineRadio2" value="1">
					  <span class="form-check-label">S</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="size" id="inlineRadio2" value="2"checked>
					  <span class="form-check-label">M</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="size" id="inlineRadio2" value="3">
					  <span class="form-check-label">L</span>
					</label>
				  </dd>
			</dl>  <!-- item-property .// -->
			<dl class="param param-inline">
				  <dt>Customizable: </dt>
				  <dd>
				  	<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="customizable" id="inlineRadio2" value="1" checked>
					  <span class="form-check-label">Default</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="customizable" id="inlineRadio2" value="2">
					  <span class="form-check-label">Sweetness</span>
					</label>
					<label class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="customizable" id="inlineRadio2" value="3">
					  <span class="form-check-label">Milk</span>
					</label>
				  </dd>
			</dl>
		</div> <!-- col.// -->
	</div> <!-- row.// -->
	<hr>
	<button class="btn btn-lg btn-primary text-uppercase"> Buy now </button>
	<button class="btn btn-lg btn-success text-uppercase" href="{{route('cart')}}"> Add to cart </button>
</form>
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
</div>
<!--container.//-->


@endsection

@section('page-js')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection