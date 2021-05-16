    <!-- Preloader -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->
    <div class="tm-top-header" id="CGOHeader">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Management</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
				<li><a href="{{route('homepage')}}" >Home</a></li>
				<li><a href="{{route('product-list')}}" >Products</a></li>
                <li><a href="{{route('user-list')}}">Users</a></li>
                <li><a href="order-history.html">Orders</a></li>
                <li><a href="{{route('cart')}}">Cart (
				@if (Session::has('Cart'))
				{{count(Session::get('Cart'))}}
				@else
					0
				@endif
				)
				</a></li>
				@if (Session::has('OrderCart'))
				<li><a href="/order-content-update/{{Session::get('OrderCartID')}}.html">Order Change ( {{count(Session::get('OrderCart'))}} )</a></li>
				@endif
                
                
                <li><a href="{{route('dashboard')}}" >Hello, {{Auth::user()->name}}.</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    

