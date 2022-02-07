      <style>
          .header-container{
              max-width: 100%;
              padding-left: 5%;
              padding-right: 5%
          }
          
      </style>
      <!-- //header style Two -->
      <header id="headerTwo" class="header-area header-two header-desktop d-none d-lg-block d-xl-block">
        @if (trans("lables.header-top-offer") != '')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <div class="container">
            <div class="pro-description">
              <div class="pro-info">
                {!!  trans("lables.header-top-offer") !!}
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>
        </div>
        @endif
  
          <div class="header-mini bg-top-bar">
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="navbar-lang">
  
                    <div class="dropdown">
                      <button class="btn dropdown-toggle language-default-name" type="button">
                        English
                      </button>
                      <div class="dropdown-menu">
                        @foreach($data['language'] as $languages)
                        <a class="dropdown-item language-default" href=" {{ url('/lang/'.$languages->code) }}" data-id={{$languages->id}} data-name="{{$languages->name}}">{{$languages->name}}</a>
                        @endforeach
                      </div>
                    </div>
        
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" id="selected-currency" type="button">
                        USD
                      </button>
                      <div class="dropdown-menu">
                        @foreach($data['currency'] as $currencies)
                          <a class="dropdown-item selected-currency" data-id="{{$currencies->id}}" data-code="{{$currencies->title}}" href="javascript:void(0)">{{$currencies->title}}</a>
                        @endforeach
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="col-12 col-md-6 without-auth-login">
            
                  <ul class="link-list pro-header-options">
                    <li class="link-item">
                      {{  trans("lables.header-welcome-user") }}
                    </li>
                    <li>
                      <li class="link-item"><a href="{{ url('/login') }}" class="nav-link -before" style="padding-right: 0;
                        color: #fff;"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;{{  trans("lables.header-login-register") }}</a></li>                      
                    </li>            
                  </ul>
        
                </div>
                <div class="col-12 col-md-6 auth-login">
                  <ul class="link-list pro-header-options">
                    <li>
                      <p> {{  trans("lables.header-welcome-text") }} <span class="welcomeUsername"></span></p>
                    </li>
                    <li class="dropdown">
                      <button class="btn dropdown-toggle" type="button">
                        {{  trans("lables.header-my-account") }}
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/profile') }}" title="{{  trans("lables.header-profile") }}">{{  trans("lables.header-profile") }}</a>
                        <a class="dropdown-item" href="{{ url('/wishlist') }}" title="{{  trans("lables.header-wishlist") }}">{{  trans("lables.header-wishlist") }}</a>
                        <a class="dropdown-item" href="{{ url('/compare') }}" title="{{  trans("lables.header-compare") }}">{{  trans("lables.header-compare") }}</a>
                        <a class="dropdown-item" href="{{ url('/orders') }}" title="{{  trans("lables.header-order") }}">{{  trans("lables.header-order") }}</a>
                        <a class="dropdown-item" href="{{ url('/shipping-address') }}" title="{{  trans("lables.header-shipping-address") }}">{{  trans("lables.header-shipping-address") }}</a>
                        <a class="dropdown-item log_out" href="javascript:void(0)" title="{{  trans("lables.header-logout") }}">{{  trans("lables.header-logout") }}</a>
                      </div>
                    </li>
                  </ul>
        
                </div>
  
                
              </div>
            </div> 
          </div>
    
          <div class="header-maxi bg-header-bar pb-0">
            <div class="container header-container">
              <div class="row align-items-center justify-content-between pb-2" style="border-bottom: 2px #eee solid;">
                <div>
                  <a href="{{url('/')}}" class="logo" data-toggle="tooltip" data-placement="bottom" title="{{isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}">
                    <img class="img-fluid" src="{{isset(getSetting()['site_logo']) ? getSetting()['site_logo'] : asset('01-logo.png') }}" alt="{{isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}">
                  </a>
                </div>
                <div>
                  <ul class="pro-header-right-options">
                    <li>
                      <a href="{{ url('/my-projects') }}" class="btn" data-toggle="tooltip" data-placement="bottom" title="{{ __("My Projects") }}">
                        <i class="far fa-folder"></i>
                        <span class="badge badge-secondary projects-count"></span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ url('/wishlist') }}" class="btn" data-toggle="tooltip" data-placement="bottom" title="{{ trans('lables.header-wishlist') }}">
                        <i class="far fa-heart"></i>
                        <span class="badge badge-secondary wishlist-count">0</span>
                      </a>
                    </li>
                    <li class="dropdown">
                      <button class="btn dropdown-toggle" type="button" id="headerOneCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="cart-left">
                          <i class="fas fa-shopping-bag"></i>
                          <span class="badge badge-secondary total-menu-cart-product-count">0</span>
                        </div>
        
                        <div class="cart-right d-flex flex-column align-self-end ml-13">
                          <span class="title-cart"> {{  trans("lables.header-cart") }} </span>
                          <span class="cart-item"> {{  trans("lables.header-item") }} </span>
                        </div>
                      </button>
                      <template id="top-cart-product-template">
                    <li class="top-cart-product-id d-flex justify-content-between">
                      <div class="item-thumb">
                        <div class="image">
                          <img class="img-fluid top-cart-product-image" src="" alt="Product Image">
                        </div>
                      </div>
                      <div class="item-detail">
                        <h3 class="top-cart-product-name"></h3>
                        <div class="item-s top-cart-product-qty-amount"></div>
                      </div>
                      <div class="item-remove d-flex justify-content-center align-items-center">
                      </div>
                    </li>
                    </template>
                    <template id="top-cart-product-total-template">
                      <li>
                        <div class="item-summary d-flex justify-content-between">
                          <span class="text-uppercase">{{  trans("lables.header-total") }}</span>
                          <span class="top-cart-product-total"></span>
                        </div>
                      </li>
                      <li>
                        <a class="btn btn-link btn-block swipe-to-top cart-menu-view-cart-btn" href="{{url('/cart')}}">{{  trans("lables.header-view-cart") }}</a>
                        <a class="btn btn-secondary btn-block  swipe-to-top cart-menu-view-checkout-btn" href="{{url('/checkout')}}">{{  trans("lables.header-checkout") }}</a>
                      </li>
                    </template>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="headerOneCartButton">
                      <label class="cart-dropdown-menu-title">Your Cart</label>
                      <ul class="shopping-cart-items top-cart-product-show">
                        <li>{{  trans("lables.header-emptycart") }}</li>
                      </ul>
        
        
                    </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div> 
          <div class="header-navbar bg-menu-bar">
            <div class="container header-container d-flex justify-content-between">
              <nav id="navbar_header_1" class="navbar navbar-expand-lg  bg-nav-bar">
                <div class="navbar-collapse">
                  <a class="navbar-brand home-icon btn-secondary swipe-to-top" href="/"><i class="fa fa-home"></i></a>
                  @include('includes.headers.main-menu')
{{--                   
                  <a class="nav-link right-menu absolute-right" href="tel:{{ isset(getSetting()['phone_number']) ? getSetting()['phone_number'] : 'N/A' }}">
                          <span>{{  trans("lables.header-header2-phone") }}</span>
                          ({{ isset(getSetting()['phone_number']) ? getSetting()['phone_number'] : 'N/A' }})
                  </a> --}}
                  
                </div>
              </nav>
              <form class="form-inline" style="position: relative">
                <input type="text" class="form-control rounded" placeholder="Search..." style="border-radius: 20px !important; width : 250px" >
                <i class="fa fa-search" style="position: absolute; right: 10px; color: #888"></i>
              </form>
            </div>
          </div>
        </header>
  
        @include('includes.headers.sticky-header')
  
        @if(isset($header_menu->menu))  
          @php $header_menu = json_decode(($header_menu->menu), true); $menuloop = 0; @endphp
         <!-- header mobile -->
         @include('includes.headers.mobile-menu')
        @endif