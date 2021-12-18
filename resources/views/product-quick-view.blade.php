<template>
    <div class="row">
        <input type="hidden" class="product-quick-view-product-id">
        {{-- Product Title --}}
        <div class="col-sm-12">
            <h4 class="product-quick-view-title"></h4>
        </div>

        {{-- Product Images --}}
        <div id="quickViewCarousel" class="carousel slide" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid quick-view-image" src="" alt="image">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="prev">
                <span class="fas fa-angle-left "></span>
            </a>
            <a class="carousel-control-next btn-secondary swipe-to-top" href="#quickViewCarousel" data-slide="next">
                <span class="fas fa-angle-right "></span>
            </a>

        </div>

        {{-- Product Price --}}
        <div class="col-sm-12">
            <h5 class="product-quick-view-price"></h5>
        </div>

        {{-- Product Categories --}}
        <div class="col-sm-12 product-quick-view-categories-container">

        </div>

        {{-- Product Features --}}
        <div class="col-sm-12">
            <div class="badges product-quick-view-features-container">
                <span class="badge badge-danger">50%</span>
                <span class="badge badge-success">featured</span>
                <span class="badge badge-info">New</span>
            </div>
        </div>

        {{-- Product Description --}}
        <div class="col-sm-12">
            <p class="product-quick-view-description"></p>
        </div>

        <div class="col-sm-12">
            <a class="btn btn-block btn-secondary swipe-to-top product-quick-view-detail-link" href="">View Detail</a>
        </div>

    </div>
</template>