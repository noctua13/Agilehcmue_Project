@extends('layouts.main')
@section('title', 'Coffe/Grand Order | Trang Người Dùng')
@section('page-css')
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
  <style type="text/css">
     @media screen and (max-width: 767px) {
    #menuCate{
      display: none;
    }
    #productGrid{
      width: 100%;
    }
    .tm-product{
      padding: 15px;
    }
  }
  </style>
@endsection
@section('content')
<section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Our Menus&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
          <h2 class="gold-text tm-welcome-header-2">Cafe House</h2>
          <p class="gray-text tm-welcome-description">The Loudest Noise Comes From The Electric Coffee.</p>
          <a href="#main" class="tm-more-button tm-more-button-welcome">Read More</a>      
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">  
      </div>      
    </section>
    <div class="tm-main-section light-gray-bg" style="padding: 15px;">
      <div class="container" id="main">
        <section class="tm-section row">
          <div class="col-lg-9 col-md-9 col-sm-8">
            <h2 class="tm-section-header gold-text tm-handwriting-font">Variety of Menus</h2>
            <h2>Cafe House</h2>
            <p class="tm-welcome-description">The excellent artisans of coffee.</p>
            <a href="#" class="tm-more-button margin-top-30">Read More</a> 
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/1.jpg" alt="Image" class="img-circle img-thumbnail">  
            </div>              
          </div>            
        </section>          
        <section class="tm-section row">
          <div class="col-lg-12 tm-section-header-container margin-bottom-30">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> Our Menus</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>
          
          <div class="row" id="productGrid">
            <div class="col-lg-4 col-md-4" id="menuCate">
              <div class="tm-position-relative margin-bottom-30">              
                <nav class="tm-side-menu">
                  <ul>
                    <li ><a id="all" href="/products.html">All</a></li>
                    @foreach($types as $protype)

                        <li ><a id="{{$protype->type}}" href="/products.html?type={{$protype->type}}">{{$protype->type}}</a></li>
                    @endforeach
                  </ul>              
                </nav>    
                <img src="img/vertical-menu-bg.png" alt="Menu bg" class="tm-side-menu-bg">
              </div>  
            </div>            
            <div class="tm-menu-product-content col-lg-8 col-md-8 col-sm-12"> <!-- menu content -->
              <div class="row">
              @foreach($products as $product)
              <!---->
              <div class=" col-6 col-sm-6 col-md-12" style="padding: 15px">
              <div class="tm-product">
                <img src="product-images/{{$product->image}}" alt="Product" height=200 width=200 >
                <div class="tm-product-text">
                  <h3 class="tm-product-title" > <a href="product/{{$product->id}}.html">{{$product->name}}</a></h3>
                  <p class="tm-product-description" style="max-width: 200px;">{!!$product->description!!}</p>
                </div>
                <div class="tm-product-price">
                  <a href="product/{{$product->id}}.html" class="tm-product-price-link tm-handwriting-font" style="line-height: 1;padding-top: 15px;"><span class="tm-product-price-currency"></span>{{$product->price}} <p class="tm-handwriting-font" style="
    font-size: 30px;
">VND</p> </a>
                </div>
              </div>
</div>
              @endforeach
            </div>
            <!--
			  <div class="tm-product">
                <img src="img/menu-1.jpg" alt="Product">
                <div class="tm-product-text">
                  <h3 class="tm-product-title">Americano 1</h3>
                  <p class="tm-product-description">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque. Red ipsum.</p>
                </div>
                <div class="tm-product-price">
                  <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">$</span>30</a>
                </div>
              </div>
			-->
            </div>
          </div>          
        </section>
      </div>
    </div> 
@endsection
@section('meta-og-system')
<meta property="og:title" content="Tâm and the bois store" />
<meta property="og:url" content="localhost/signup.html" />
<meta property="og:image" content="site-images/tamamoSad.png" />
<meta property="og:description" content="Description" />
<meta property="og:type" content="website" />
@endsection
@section('page-js')
<link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script> 
   <script type="text/javascript">
   
    $(document).ready(function(){

    if (window.location.href=="http://127.0.0.1:8000/products.html") {
      $('#all').attr('class','active');
    }
    else {
    var get = "<?php Print($gettype); ?>";
    var x = document.getElementById(get);
    x.classList.add("active");
    //$(get).attr('class','active');
    }
  })
    
   </script>
@endsection