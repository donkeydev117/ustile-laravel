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
                            {{-- <div class="icon swipe-to-top quick-view-icon" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Quick View">
                                <i class="fas fa-eye"></i>
                            </div> --}}
                            <div class="icon swipe-to-top compare-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Compare" data-original-title="Add to Compare">
                                <i class="fas fa-align-right" data-fa-transform="rotate-90"></i>
                            </div>
                            {{-- <div class="icon swipe-to-top project-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Project" data-original-title="Add to Project" data-toggle="modal" data-target="#addToProjectModal">
                                <i class="fas fa-folder" data-fa-transform="rotate-90"></i>
                            </div> --}}
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
                        </div>
                        <a class="btn btn-block btn-secondary swipe-to-top product-card-link" href="javascript:void(0)"
                            data-toggle="tooltip" data-placement="bottom" title=""
                            data-original-title="View Detail">View Detail</a>
                    </div>
                    <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
                </div>
                <span class="d-none product-card-category"></span>
                <div class="content pt-2">
                    <h5 class="title"><a href="javascript:void(0)" class="product-card-name"></a></h5>
                    <div class="row mt-2 action-buttons">
                        <div class="col-4 text-center pl-0 pr-0">
                            <a href="#" class="quick-view-icon">
                                <i class="far fa-eye"></i>
                                <span>Quick View</span>
                            </a>
                        </div>
                        <div class="col-4 text-center pl-0 pr-0">
                            <a href="javascript:void(0)" class="select-options-icon">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Select Options</span>
                            </a>
                        </div>
                        <div class="col-4 text-center pl-0 pr-0">
                            <a class="add-project-icon project-icon" href="javascript:void(0)" data-toggle="modal" data-target="#addToProjectModal">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add Project</span>
                            </a>
                        </div>
                    </div>
                    <div class="red-content mt-4">
                        <div class="row">
                            <div class="col-6 border-right-white text-right">
                                <a class="text-uppercase text-white add-to-cart-link" href="#">Add to Cart</a>
                            </div>
                            <div class="col-6">
                                <span class="price-link text-white">$7.11 - $7.51/SQFT</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</template>
