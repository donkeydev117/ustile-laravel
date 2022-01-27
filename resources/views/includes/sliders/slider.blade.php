 <style>
     .carousel-control-prev{
         left: -90px !important;
         background: transparent !important;
         overflow: initial !important;
         opacity: 1 !important;
         border:0 !important;
     }
     .carousel-control-next{
         right: -90px !important;
         background: transparent !important;
         overflow: initial !important;
         opacity: 1 !important;
         border:0 !important;
     }

     .carousel-control-prev img,
     .carousel-control-next img {
         width : 38px;
     }
     .carousel-control-next::before,
     .carousel-control-prev::before{
         content: "" !important;
     }
     .carousel-control-next::after,
     .carousel-control-prev::after{
         display: none;
     }

 </style>
 <!-- Bootstrap Caption Carousel Content Full Width -->
 <section class="carousel-content">
    <div class="container header-container">
      
      <div id="carouselExampleWithCaptions2" class="carousel slide shimmer-background" data-ride="carousel">
        <ol class="carousel-indicators" style="direction:ltr;">
          <li id="slider-bullets-0" data-target="#carouselExampleWithCaptions2" data-slide-to="0" class="active"></li>
          <li id="slider-bullets-1" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="1"></li>
          <li id="slider-bullets-2" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="2"></li>
          <li id="slider-bullets-3" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="3"></li>
          <li id="slider-bullets-4" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="4"></li>
          <li id="slider-bullets-5" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="5"></li>
          <li id="slider-bullets-6" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="6"></li>
          <li id="slider-bullets-7" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="7"></li>
          <li id="slider-bullets-8" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="8"></li>
          <li id="slider-bullets-9" class="d-none" data-target="#carouselExampleWithCaptions2" data-slide-to="9"></li>
        </ol>
      
        <template id="slider-navigation-template">
          <div class="carousel-item slider-navigation-active">
            <img class="d-block w-100 slider-navigation-image" src="" alt="">
            <div class="carousel-caption d-none d-md-flex  ">
                <div class="text-deco1">
                    <h2 class="slider-navigation-title"></h2>
                    <p class="slider-navigation-desc"></p>
                    <a href="javascript:void(0)"  class="slider-navigation-url btn btn-secondary swipe-to-top">
                      {{  trans("lables.home-slider-button-title") }}
                    </a>
                  </div>
              </div>
          </div>
        </template>
    
        <div class="carousel-inner slider-navigation-show"></div>
    
        <a class="carousel-control-prev" href="#carouselExampleWithCaptions2" role="button" data-slide="prev">
            <img src="{{ asset('/images/arrow-left.png')}}" />
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleWithCaptions2" role="button" data-slide="next">
            <img src="{{ asset('/images/arrow-right.png')}}" />
          <span class="sr-only">Next</span>
        </a>
    
      </div>
      
    </div>
  </section>