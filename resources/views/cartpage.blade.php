@extends('layouts.master')

<style>
    #btn_update_cart,
    #btn_continue_shopping {
        width : 250px;
    }
    #btn_update_cart{
        background-color: #ef5f4b;
        color: #fff;
    }
    #btn_update_cart:hover{
        color: #333;
    }
    .quantity-left-minus{
        padding: 0 !important;
        position: absolute;
        left: 5px;
        top: 0;
        width: 20px;
        z-index: 2;
        bottom: 0;
    }
    .quantity-right-plus{
        padding: 0 !important;
        position: absolute;
        right: 5;
        top: 0;
        bottom: 0;
        z-index: 2;
    }
    .quantity-left-minus span,
    .quantity-right-plus span{
        font-size: 12px;
        color: #ef5f4b;
    }

    .cartItem-image {
        width: 100%;
        /* height: 100px; */
    }

    .cart-page-one .top-table tbody tr td{
        justify-content: flex-start !important;
    }

    .cart-main-content{
        margin-top: 1rem;
        padding-top: 1rem;
        padding-left: 4rem;
        padding-right: 4rem;
    }
    .item-attributes div{
        font-size: 14px;
        color: #888
    }
    .item-attributes div span{
        color: #000;
        font-weight: 600;
    }
    #cartItem-product-show .item-price{
        display: block
    }
    .cart-item-boxsize-container{
        font-size: 12px;
    }
    .cartItem-price {
        font-size: 18px;
    }
    .cart-page-one .top-table tbody tr{
        border: none !important;
    }
    .cart-item-count{
        font-size: 18px;
    }
</style>

@section('content')
    @include('includes.cartpages.cartpage')
    <input type="hidden" id="totalItems" value="0" />
@endsection
@section('script')
    <script>
        languageId = $.trim(localStorage.getItem("languageId"));
        cartSession = $.trim(localStorage.getItem("cartSession"));
        if (cartSession == null || cartSession == 'null') {
            cartSession = '';
        }
        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        customerToken = $.trim(localStorage.getItem("customerToken"));

        $(document).ready(function() {
            if (loggedIn == '1') {
                cartItem('');
                menuCart('');
            } else {
                cartItem(cartSession);
                menuCart(cartSession)
            }
        });

        function couponCartItem() {
            coupon_code = $.trim($("#coupon_code").val());
            if (coupon_code == '') {
                toastr.error('{{ trans("coupon-code-required") }}');
                price = $(".caritem-subtotal").attr('price-symbol');
                $(".caritem-discount-coupon").html('');
                localStorage.setItem("couponCart", '');
                $(".caritem-grandtotal").html(price);
                return;
            }

            if($.trim($("#totalItems").val()) == '0'){
                toastr.error('{{ trans("cart-is-empty") }}');
                return;
            }
            
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/coupon?currency='+localStorage.getItem("currency"),
                data: {
                    coupon_code: coupon_code,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + customerToken,
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#coupon_code").val(coupon_code);
                    if (data.status == 'Success') {
                        if (data.data.type == 'fixed') {
                            price = $(".caritem-subtotal").attr('price');
                            if(data.data.currency != '' && data.data.currency != 'null' && data.data.currency != null){
                                price1 = (price - (data.data.amount * data.data.currency.exchange_rate ));
                                if(data.data.currency.symbol_position == 'left'){
                                    $(".caritem-discount-coupon").html(data.data.currency.code +' '+ data.data.amount);
                                    $(".caritem-grandtotal").html(data.data.currency.code +' '+ price1.toFixed(2));
                                }
                                else{
                                    $(".caritem-discount-coupon").html(data.data.amount +' '+ data.data.currency.code);
                                    $(".caritem-grandtotal").html(price1.toFixed(2) +' '+ data.data.currency.code);
                                }
                            }
                        } else {
                            if(data.data.currency != '' && data.data.currency != 'null' && data.data.currency != null){
                                if(data.data.currency.symbol_position == 'left'){
                                    price = $(".caritem-subtotal").attr('price');
                                    price1 = (price / 100) * data.data.amount;
                                    $(".caritem-discount-coupon").html(data.data.currency.code +' '+ price1.toFixed(2));
                                    price = price - price1
                                    $(".caritem-grandtotal").html(data.data.currency.code +' '+ price.toFixed(2));
                                }
                                else{
                                    price = $(".caritem-subtotal").attr('price');
                                    price1 = (price / 100) * data.data.amount;
                                    $(".caritem-discount-coupon").html(price1.toFixed(2) +' '+ data.data.currency.code);
                                    price = price - price1
                                    $(".caritem-grandtotal").html(price.toFixed(2) +' '+ data.data.currency.code);
                                }
                            }
                        }
                        localStorage.setItem("couponCart", coupon_code);
                    } else {
                        price = $(".caritem-subtotal").attr('price-symbol');
                        $(".caritem-discount-coupon").html('');
                        $(".caritem-grandtotal").html(price);
                        localStorage.setItem("couponCart", '');
                        toastr.error('{{ trans("invalid-coupon") }}');
                    }
                },
                error: function(data) {
                    price = $(".caritem-subtotal").attr('price-symbol');
                    $(".caritem-discount-coupon").html('');
                    $(".caritem-grandtotal").html(price);
                    localStorage.setItem("couponCart", '');
                    if (data.status == 401) {
                        // toastr.error(data.res
                        toastr.error('{{ trans('response.please_login_first') }}')
                    }
                },
            });
        }


        function updateCartItem() {
            len = $(".cartItem-row").length;
            for (i = 0; i < len; i++) {
                product_id = $(".cartItem-row").eq(i).attr('product_id');
                qty = $(".cartItem-row").eq(i).find('.cartItem-qty').val();

                product_type = $(".cartItem-row").eq(i).attr('product_type');
                product_combination_id = '';
                if (product_type == 'variable') {
                    if ($.trim($(".cartItem-row").eq(i).attr('product_combination_id')) == '' || $.trim($(".cartItem-row")
                            .eq(i).attr('product_combination_id')) == 'null') {
                        toastr.error('{{ trans("combination-missing") }}');
                        return;
                    }
                    product_combination_id = $(".cartItem-row").eq(i).attr('product_combination_id');
                }

                addToCartFun(product_id, product_combination_id, cartSession, qty);
            }

            cartItem(cartSession);
            couponCart = $.trim(localStorage.getItem("couponCart"));
            if (couponCart != 'null' && couponCart != '') {
                $("#coupon_code").val(couponCart);
                couponCartItem();
            }
        }


        $(document).on('click', '.quantity-right-plus', function() {
            var row_id = $(this).attr('data-field');

            var quantity = $('#quantity' + row_id).val();
            $('#quantity' + row_id).val(parseInt(quantity) + 1);
        })

        $(document).on('click', '.quantity-left-minus', function() {
            var row_id = $(this).attr('data-field');
            var quantity = $('#quantity' + row_id).val();
            if (quantity > 1)
                $('#quantity' + row_id).val(parseInt(quantity) - 1);
        })
    </script>
@endsection
