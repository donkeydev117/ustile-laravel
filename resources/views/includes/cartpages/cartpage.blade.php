

<section class="cart-main-content">
    <div class="container-fluid">
        <div class="page-heading-title">
            <h2>{{ trans('lables.cart-page-shopping-cart') }} <span class="cart-item-count"></span></h2>
        </div>
    </div>


    <!-- cart Content -->
    <section class="cart-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 cart-area cart-page-one">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table top-table">
                                        <tbody id="cartItem-product-show">

                                        </tbody>
                                    </table>
                                    <div class="col-12 col-lg-12 mb-4">
                                        <div class="row justify-content-between click-btn">
                                            <div class="col-12 col-lg-4">
                                                {{-- <div class="row">
                                                    <div class="input-group">
                                                        <input type="text" id="coupon_code" class="form-control" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="coupon-code">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary swipe-to-top" type="button" onclick="couponCartItem()" id="coupon-code">{{ trans('lables.cart-page-apply') }}</button>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="col-12 col-lg-8 align-right">
                                                <div class="row">
                                                    <button type="button" class="btn btn-secondary swipe-to-top" id="btn_continue_shopping">{{ trans('lables.cart-page-continue-shopping') }}</button>
                                                    <button type="button" class="btn btn-light swipe-to-top" id="btn_update_cart" onclick="updateCartItem()">{{ trans('lables.cart-page-update-cart') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            
                        </div>
                        <div class="col-12 col-lg-3">
                           
                            <table class="table right-table" id="cartItem-grandtotal-product-show">

                            </table>
                            <a href="{{url('/checkout')}}">
                                <button class="btn btn-secondary swipe-to-top m-btn col-12">{{ trans('lables.cart-page-proceed-to-checkout') }}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <template id="cartItem-Template">
        <tr class="d-flex cartItem-row">
            <td class="col-12 col-sm-2 col-md-2">
                <img class="cartItem-image" src="" />
            </td>
            <td class="col-12 col-sm-4 col-md-3 item-detail-left">
                <div class="item-detail">
                    {{-- <span class="cartItem-category-name"></span> --}}
                    <h4 class="cartItem-name"></h4>
                    <div class="item-attributes">
                        <div class="mb-1">Size: <span class="cart-item-size"></span></div>
                        <div class="mb-1">Color: <span class="cart-item-color"></span></div>
                        <div class="mb-1">Finish: <span class="cart-item-finish"></span></div>
                        <div class="mb-1">Look: <span class="cart-item-look"></span></div>
                        <div class="mb-1">Shape: <span class="cart-item-shape"></span></div>

                    </div>
                </div>
            </td>
            <td class="item-price col-12 col-md-2 ">
                <div class="cartItem-price "></div>
                <div class="mt-1 d-inline-block cart-item-boxsize-container"><span class="cart-item-boxsize"></span> / box</div>
            </td>
            <td class="col-12 col-md-2">
                <div class="input-group item-quantity">
                    <button type="button" value="quantity" class="quantity-left-minus btn cartItem-qty-2" data-type="minus" data-field="">
                        <span class="fas fa-minus"></span>
                    </button>
                    <input type="text" id="quantity2" name="quantity" class="form-control cartItem-qty">
                    <button type="button" value="quantity" class="quantity-right-plus btn cartItem-qty-1" data-type="plus" data-field="">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
            </td>
            <td class="align-middle item-total col-12 col-md-2 cartItem-total" align="center"></td>
            <td class="item-action col-12 col-md-1">
                <div class="item-controls">
                    <button type="button" class="btn cartItem-remove pl-2 pr-2">
                        <span class="fas fa-times"></span>
                    </button>
                </div>
            </td>
        </tr>
    </template>


    <template id="cartItem-grandtotal-template">

        <thead>
            <tr>
                <th scope="col" colspan="2" align="center">{{ trans('lables.cart-page-order-summary') }}</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ trans('lables.cart-page-subtotal') }}</th>
                <td align="right" class="caritem-subtotal"></td>

            </tr>
            <tr>
                <th scope="row">{{ trans('lables.cart-page-discount') }}</th>
                <td align="right" class="caritem-discount-coupon"></td>

            </tr>
            
            <tr class="item-price">
                <th scope="row">{{ trans('lables.cart-page-total') }}</th>
                <td align="right" class="caritem-grandtotal"></td>

            </tr>


        </tbody>


    </template>

</section>


