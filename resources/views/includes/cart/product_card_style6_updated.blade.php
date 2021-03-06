<template id="product-card-template">
    <div class="div-class">
        <div class="product product13 ratingstar">
            <article>
                <div class="thumb">

                    <div class="product-hover d-none d-lg-block d-xl-block">
                        <div class="icons">

                            <a href="javascript:void(0)" class="wishlist-icon icon active swipe-to-top" data-toggle="tooltip"
                                data-placement="bottom" title="" data-original-title="Wishlist">
                                <i class="fas fa-heart"></i>
                            </a>
                            <div class="icon swipe-to-top quick-view-icon" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Quick View">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="icon swipe-to-top compare-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Compare" data-original-title="Add to Compare">
                                <i class="fas fa-align-right" data-fa-transform="rotate-90"></i>
                            </div>
                            <div class="icon swipe-to-top project-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Project" data-original-title="Add to Project" data-toggle="modal" data-target="#addToProjectModal">
                                <i class="fas fa-folder" data-fa-transform="rotate-90"></i>
                            </div>
                            <div class="icon swipe-to-top add-to-cart-icon" 
                                data-tooltip="tooltip" 
                                data-placement="bottom" 
                                title="Add to Cart" 
                                data-original-title="Add to Cart"
                                data-toggle="modal"
                                data-target="#addToCartModal"
                            >
                                <i class="fas fa-shopping-cart" data-fa-transform="rotate-90"></i>
                            </div>
                            {{-- <a href="javascript:void(0)" class="icon swipe-to-top compare-icon" data-toggle="tooltip"
                                data-placement="bottom" title="" data-original-title="Compare"><i
                                    class="fas fa-align-right" data-fa-transform="rotate-90"></i></a> --}}
                        </div>
                        <a class="btn btn-block btn-secondary swipe-to-top product-card-link" href="javascript:void(0)"
                            data-toggle="tooltip" data-placement="bottom" title=""
                            data-original-title="View Detail">View Detail</a>

                    </div>

                    <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
                </div>
                <span class="d-none product-card-category">

                </span>
                <div class="content">
                    <div class="pro-rating rating-none listing-none">
                        <fieldset class="disabled-ratings display-rating">
                        </fieldset>
                    </div>
                    <h5 class="title"><a href="javascript:void(0)" class="product-card-name"></a></h5>
                    <p class="para product-card-desc"></p>
                    <div class="pro-rating">
                        <fieldset class="disabled-ratings rating-none listing1-show display-rating1">
                        </fieldset>
                    </div>
                    <div class="price product-card-price">
                    </div>


                </div>

            </article>
        </div>
    </div>
</template>
