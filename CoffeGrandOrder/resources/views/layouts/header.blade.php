    <!-- Preloader -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
              <li><a href="{{route('homepage')}}" >Home</a></li>
                <li><a href="{{route('today-special')}}">Today Special</a></li>
                <li><a href="{{route('products')}}">Menu</a></li>
                <li><a href="{{route('contact')}}">Contact</a></li>
                
                <?php

                if (isset(Auth::user()->name)){
                  echo "<li><a href='/dashboard.html'> Hello, ".Auth::user()->name."</a></li>";
                }
                else {
                  echo "<li><a href='/login.html'>Login</a></li>
                  <li><a href='/signup.html'>Sign Up</a></li>";
                }
                ?>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    

