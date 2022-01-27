<section class="categories-content pro-content">
    <div class="container">
      <div class="products-area">
         <div class="row justify-content-center">
           <div class="col-12 col-lg-6">
             <div class="pro-heading-title">
               <h2> {{ trans('lables.home-product-categories-title') }}
               </h2>
               <p>{{ trans('lables.home-product-categories-description') }}</p>
               </div>
             </div>
         </div>
         <div class="row" id="categories-template-container">

         </div>
      </div>
    </div>


{{-- <template id="category-slider-template">
    <div class="">
        <div class="cat-banner">
          <a class="category-slider-url" href="">
          <figure class="categories-image categories-icon">
      
              <img class="img-fluid category-slider-image" src="" alt="Banner Image">
          
            <div class="categories-title">
              <h3 class="category-slider-title"></h3>
            </div>
          </figure>
          </a>
        </div>
      </div>
</template> --}}

  <template id="category-template">
    <div class="col-12 col-sm-4 d-flex align-items-center mt-2">
      <a class="category-slider-url" href="#">
        <figure class="category-image">
          <div class="hexagon">
            <div class="hexTop"></div>
            <div class="hexBottom"></div>
          </div>
          <div class="category-title">
            <h4 class="category-slider-title text-center pt-2"></h4>
          </div>
        </figure>
      </a>
    </div>
  </template>
   <div class="general-product">
    <div class="container p-0">
      <div class="category-slider-show">

      </div>
    </div>
  </div>

  </section>