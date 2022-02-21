<template id="product_template">
    <li class="product-template-container-li">
        <div class="div-class">
            <article>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <img class="product-image" />
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 d-flex justify-content-center align-items-center" style="flex-direction: column">
                        <div class="clickable">
                            <button class="btn btn-link btn-icon btn-remove">
                                <i class="fa fa-close"></i>
                            </button>
                            <button class="btn btn-link btn-icon btn-edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-link btn-icon btn-clone">
                                <i class="fa fa-clone"></i>
                            </button>
                            <button 
                                class="btn btn-link btn-icon add-to-cart-icon" 
                                data-tooltip="tooltip" 
                                data-placement="bottom" 
                                title="Add to cart"
                                data-original-title="Add to cart"
                                data-toggle="modal"
                                data-target="#addToCartModal"
                            >
                                <i class="fas fa-shopping-cart" data-fa-transform="rotate-90"></i>
                            </button>
                        </div>
                        <a class="product-title clickable" href="#" target="_blank"></a>
                        <div class="product-price"></div>
                    </div>
                    <div class="col-xs-4 col-sm-4 clickable d-flex justify-content-center align-items-center">
                        <div class="product-tags"></div>
                    </div>
                </div>
            </article>
        </div>
    </li>
</template>