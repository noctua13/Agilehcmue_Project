@if(Session::has('success-register'))
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Success!!</strong> Your Accout has been registed!
</div>
  {{Session::forget('success-register')}}
@endif
@extends('layouts.main')
@section('title', 'Coffee/Grand Order | Trang Chủ')
@section('page-css')
<link href="{{ asset('/css/templatemo-style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon" />
  <style>
    .alert {
      padding: 20px;
      background-color: #4CAF50;
      color: white;
    }
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
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

<section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;Welcome To&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
          <h2 class="gold-text tm-welcome-header-2">Cafe House</h2>
          <h3 class="gray-text tm-welcome-description">Coffee only if you want the best.</h3>
          <a href="#main" class="tm-more-button tm-more-button-welcome">Details</a>      
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">             
      </div>      
    </section>
    <div class="tm-main-section light-gray-bg">
      <div class="container" id="main">
        <section class="tm-section row">
          <div class="col-lg-9 col-md-9 col-sm-8">
            <h2 class="tm-section-header gold-text tm-handwriting-font">The Best Coffee for you</h2>
            <h2>Cafe House</h2>
            <h3 >Go ahead! Take your Coffee!.</h3>
            <a href="#" class="tm-more-button margin-top-30">Read More</a> 
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/1.jpg" alt="Image" class="img-circle img-thumbnail">  
            </div>              
          </div>            
        </section>          
        <section class="tm-section tm-section-margin-bottom-0 row">
          <div class="col-lg-12 tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> Popular Items</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>

          <div class="col-lg-12 tm-popular-items-container">

            <!-- <div class="tm-popular-item">
              <img src="img/america.png" style="width: 286px; height: 286px;" alt="Popular" class="tm-popular-item-img">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">A</span>mericano</h3><hr class="tm-popular-item-hr">
                <p>Là một phong cách cà phê chuẩn bị bằng cách thêm nước nóng vào espresso, điều này làm cà phê có độ đậm tương tự, nhưng hương vị lại khác, giống cà phê phin.</p>
                <div class="order-now-container">
                  <a href="#" class="order-now-link tm-handwriting-font">Order Now</a>
                </div>
              </div>              
            </div>

            <div class="tm-popular-item">
              <img src="img/capucino.png" style="width: 286px; height: 286px;" alt="Popular" class="tm-popular-item-img">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">C</span>appuccino</h3><hr class="tm-popular-item-hr">
                <p>Ở Ý, quốc gia mà đồ uống này phổ biến nhất, theo truyền thống, được thưởng thức vào buổi sáng, vào bữa sáng hoặc sau đó, không bao giờ trong bữa ăn.</p>
                <div class="order-now-container">
                  <a href="#" class="order-now-link tm-handwriting-font">Order Now</a>
                </div>
              </div>              
            </div>

            <div class="tm-popular-item">
              <img src="img/mocha.png" style="width: 286px; height: 286px;" alt="Popular" class="tm-popular-item-img">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title"><span class="tm-handwriting-font bigger-first-letter">M</span>ocha</h3><hr class="tm-popular-item-hr">
                <p>Giống với tách cà phê latte, cà phê mocha dựa trên espresso và sữa nóng nhưng có thêm hương vị sô cô la và chất làm ngọt, thường ở dạng bột ca cao và đường.</p>
                <div class="order-now-container">
                  <a href="#" class="order-now-link tm-handwriting-font">Order Now</a>
                </div>
              </div>              
            </div> -->
             @foreach($analize as $product)
              
            <div class="tm-popular-item">
              <img src="product-images/{{$product->image}}" style="width: 286px; height: 286px;" alt="Popular" class="tm-popular-item-img">
              <div class="tm-popular-item-description">
                <h3 class="tm-handwriting-font tm-popular-item-title">{{$product->name}}</h3><hr class="tm-popular-item-hr">
                <h4>Total order: {{$product->sum}}</h4>
                <p>{!!$product->description!!}</p>
                <div class="order-now-container">
                  <a href="/product/{{$product->productid}}.html" class="order-now-link tm-handwriting-font">Order Now</a>
                </div>
              </div>              
            </div>
   
              @endforeach   

          </div>     
             
        </section>

        <section class="tm-section row">
          <div class="col-lg-12 tm-section-header-container">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> Today's Special</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>          
          <div class="col-lg-12 tm-special-container margin-top-60">
            <div class="tm-special-container-left"> <!-- left -->
              <div class="tm-special-item">
                <div class="tm-special-img-container">
                  <img src="img/special-1.jpg" alt="Special" class="tm-special-img img-responsive">  
                  <a href="#">
                    <div class="tm-special-description">
                      <h3 class="tm-special-title">The royal taste.</h3>
                      <p>Feel high!</p>  
                    </div>            
                  </a>
                </div>
              </div>
            </div>
            <div class="tm-special-container-right"> <!-- right -->
              <div>
                <div class="tm-special-item">
                  <div class="tm-special-img-container">
                    <img src="img/special-2.jpg" alt="Special" class="img-responsive">  
                    <a href="#">
                      <div class="tm-special-description">
                        <h3 class="tm-special-title">The Mugs of Paradise.</h3>
                        <p>Your life should be hell.</p>
                      </div>
                    </a>
                  </div>
                </div>  
              </div>
              <div class="tm-special-container-lower">
                <div class="tm-special-item">
                  <div class="tm-special-img-container">
                    <img src="img/special-3.jpg" alt="Special" class="img-responsive">  
                    <a href="#">
                      <div class="tm-special-description">
                        <p>Dark and Refined freshness</p>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="tm-special-item">
                  <div class="tm-special-img-container">
                    <img src="img/special-4.jpg" alt="Special" class="img-responsive">  
                    <a href="#">
                      <div class="tm-special-description">
                        <p>Rice and Sip</p>
                      </div>
                    </a>
                  </div>
                </div>  
              </div>              
            </div>
          </div>
        </section>
        <section class="tm-section">
          <div class="row">
            <div class="col-lg-12 tm-section-header-container">
              <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> Daily Menu</h2> 
              <div class="tm-hr-container"><hr class="tm-hr"></div> 
            </div>  
          </div>          
          <div class="row">
            <div class="tm-daily-menu-container margin-top-60" style="width: 100%;">
              <div class="col-lg-4 col-md-4">
                <img src="img/menu-board.png" alt="Menu board" class="tm-daily-menu-img">      
              </div>            
              <div class="col-lg-8 col-md-8">
                <p>Crazy about coffee, here is your asylum.</p>
                <ol class="margin-top-30">
                  <li>Americano</li> 
                  <li>Cappuccino</li>
                  <li>Mocha</li> 
                  <li>Pure black coffee</li> 
                  <li>Coco Choco</li> 
                  <li>Onigiri</li> 
                </ol>
                <a href="#" class="tm-more-button margin-top-30">Read More</a>    
              </div>
            </div>
          </div>          
        </section>
      </div>
    </div> 
@endsection

@section('page-js')
<script type="text/javascript" src="./js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
   <script type="text/javascript" src="./js/templatemo-script.js"></script> 
   <link href="{{ asset('js/templatemo-script.js') }}" rel="script">
  <link href="{{ asset('js/jquery-1.11.2.min.js') }}" rel="script">
  
@endsection
