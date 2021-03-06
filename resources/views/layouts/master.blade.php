{{-- {{ dd(getSetting()['card_style']) }} --}}
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="UTF-8">
    <title>{{ isset(getSetting()['seo_title']) ? getSetting()['seo_title'] : 'Seo Title' }}</title>
    <meta name="description"
        content="{{ isset(getSetting()['seo_description']) ? getSetting()['seo_description'] : 'Seo Description' }}">
    <meta name="keywords"
        content="{{ isset(getSetting()['seo_keywords']) ? getSetting()['seo_keywords'] : 'Seo Keywords' }}">
    <meta name="author" content="">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png"
        href="{{ isset(getSetting()['favicon']) ? getSetting()['favicon'] : '01-fav.png' }}">

    <!-- Fontawesome CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Core CSS Files -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ isset(getSetting()['color']) ? asset('assets/front/css/'.getSetting()['color'].'.css') :  asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/dropdown.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/front/lightbox2/css/lightbox.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/front/magnify-image-hover/css/jquery.jqZoom.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css')}}" rel='stylesheet'  />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .header-two .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items,
        .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items,
        .header-mobile .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items {
            max-height: 600px;
        }
        .header-two .header-maxi .pro-header-right-options .dropdown .dropdown-menu,
        .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu,
        .header-mobile .header-maxi .pro-header-right-options .dropdown .dropdown-menu {
            width : 320px;
        }
        .top-cart-product-image {
            height: 100%;
        }
        .cart-dropdown-menu-title {
            font-size: 20px;
            margin-left: 1.5rem;
            text-transform: uppercase;
        }
        .cart-menu-view-cart-btn{
            background-color : #ef5f4b;
            color: #fff;
        }
        .cart-menu-view-cart-btn:hover{
            background-color: #ef5f4b;
            color : #fff
        }

        .item-remove{
            cursor: pointer;
        }
        .header-two .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-thumb .image,
        .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li .item-thumb .image {
            width : 60px;
            height: 60px;
        }
        .header-two .header-maxi .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li,
        .sticky-header .header-sticky-inner .pro-header-right-options .dropdown .dropdown-menu .shopping-cart-items li{
            padding-bottom: 25px;
            margin-bottom: 15px;
        }

    </style>

</head>

<body class="animation-s1 {{ $data['direction'] === 'rtl' ? 'bodyrtl' : '' }}">

    @include('extras.preloader')
    @include('includes.headers.header')


    @yield('content')


    @include(isset(getSetting()['Footer_style']) ? 'includes.footers.footer-'.getSetting()['Footer_style'] :
    'includes.footers.footer-style1')


    <a href="javascript:void(0)" class="btn-secondary swipe-to-top" id="back-to-top" data-toggle="tooltip"
        data-placement="bottom" data-original-title="{{ trans('lables.general-backtotop') }}"
        title="{{ trans('lables.general-backtotop') }}">&uarr;</a>

    <div class="mobile-overlay"></div>

    <div class="notifications" id="notificationWishlist">Product Added To Wishlist</div>



    @include('extras.settings')
    @include('modals.product-quick-view')
    @include('modals.addToProjectModal')
    @include("modals.createProjectModal")
    @include('modals.addToCartModal')

    <!-- All custom scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/front/js/jquery.dropdown.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/assets/front/js/jquery-sortable-lists.min.js"></script>
    <script src="{{ asset('assets/front/lightbox2/js/lightbox.min.js')}}"></script>
    <script src="{{ asset('assets/front/magnify-image-hover/js/jquery.jqZoom.js')}}"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>
    
    <script src="{{ asset('assets/front/js/scripts.js') }}"></script>

    @php
        $language_id = $data['selectedLenguage'];
        $locale = session()->get('locale');
    @endphp
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        customerFname = $.trim(localStorage.getItem("customerFname"));
        customerLname = $.trim(localStorage.getItem("customerLname"));
        customerEmail = $.trim(localStorage.getItem("customerEmail"));
        customerId = $.trim(localStorage.getItem("customerId"));

        if (loggedIn != '1') {
            $(".auth-login").remove();
        } else {
            $(".without-auth-login").remove();
            $(".welcomeUsername").html(customerFname + " " + customerLname);
            $('.profile-username').html(customerFname + " " + customerLname);
            $('.profile-user-email').html(customerEmail);
        }

        customerToken = $.trim(localStorage.getItem("customerToken"));


        languageId = localStorage.getItem("languageId");
        languageName = localStorage.getItem("languageName");

        if (languageName == null || languageName == 'null') {
            localStorage.setItem("languageId", $.trim("{{ $data['selectedLenguage'] }}"));
            localStorage.setItem("languageName", $.trim("{{ $data['selectedLenguageName'] }}"));
            $(".language-default-name").html($.trim("{{ $data['selectedLenguageName'] }}"));
            languageId = $.trim("{{ $data['selectedLenguage'] }}");
        } else {
            $(".language-default-name").html(localStorage.getItem("languageName"));
            $('.mobile-language option[value="' + localStorage.getItem("languageId") + '"]').attr('selected', 'selected');
        }

        currency = localStorage.getItem("currency");
        currencyCode = localStorage.getItem("currencyCode");
        if (currencyCode == null || currencyCode == 'null') {
            localStorage.setItem("currency", $.trim("{{ $data['selectedCurrency'] }}"));
            localStorage.setItem("currencyCode", $.trim("{{ $data['selectedCurrencyName'] }}"));
            $("#selected-currency").html($.trim("{{ $data['selectedCurrencyName'] }}"));
            currency = 1;
        } else {
            $("#selected-currency").html(localStorage.getItem("currencyCode"));
            $('.currency option[value="' + localStorage.getItem("languageId") + '"]').attr('selected', 'selected');
        }


        cartSession = $.trim(localStorage.getItem("cartSession"));
        if (cartSession == null || cartSession == 'null') {
            cartSession = '';
        }

        $(document).ready(function() {

            if (loggedIn != '1') {
                localStorage.setItem("cartSession", cartSession);
                menuCart(cartSession);
            } else {
                menuCart('');
            }

            getWishlist();

            // Nice Scroll Setting

            $(".nicescroll").niceScroll();

            $(".grid-masonry").masonry({
                itemSelector: '.grid-masonry-item',
                columnWidth: 200
            })


        });

        function getSliderSettings(className) {
            jQuery(document).ready(function() {
                (function(jQuery) {
                    var tabCarousel = jQuery('.' + className);
                    if (tabCarousel.length) {

                        tabCarousel.each(function() {
                            var thisCarousel = jQuery(this),
                                item = jQuery(this).data('item'),
                                itemmobile = jQuery(this).data('itemmobile');



                            thisCarousel.slick({
                                lazyLoad: 'progressive',
                                dots: false,
                                arrows: true,
                                infinite: false,
                                // variableWidth: true,
                                //rtl:true,
                                speed: 300,
                                slidesToShow: item || 4,
                                slidesToScroll: item || 4,
                                adaptiveHeight: true,
                                responsive: [{
                                        breakpoint: 1200,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 3,
                                            arrows: false,
                                        }
                                    },
                                    {
                                        breakpoint: 992,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 576,
                                        settings: {
                                            slidesToShow: itemmobile || 1,
                                            slidesToScroll: itemmobile || 1
                                        }
                                    }
                                ]
                            });
                        });
                    };

                })(jQuery);
            });
        }

        function getWishlist() {
            if (loggedIn != '1') {
                return;
            }

            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/wishlist',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".wishlist-count").html(data.data.length);
                    }
                },
                error: function(data) {},
            });
        }



        function addWishlist(input) {
            if (loggedIn != '1') {
                toastr.error('{{ trans('response.please_login_first') }}')
                return;
            }

            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/wishlist?product_id=' + $(input).attr('data-id'),
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".wishlist-count").html(data.data.length);
                        toastr.success('{{ trans('wishlist-add-success') }}')
                    }
                },
                error: function(data) {},
            });
        }


        function addCompare(input) {
            if (loggedIn != '1') {
                toastr.error('{{ trans('response.please_login_first') }}')
                return;
            }


            customerId = $.trim(localStorage.getItem("customerId"));
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/compare?product_id=' + $(input).attr('data-id') +
                    '&customer_id=' + customerId,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        toastr.success('{{ trans('response.compare-add-success') }}')

                    }
                },
                error: function(data) {},
            });
        }

        function quiclViewData(input) {
            product_type = $.trim($(input).attr('data-type'));
            product_id = $.trim($(input).attr('data-id'));
            $(".quick-view-modal-show").html('');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/products/' + product_id +
                    '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency=' + localStorage.getItem(
                        "currency"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        const templ = document.getElementById("quick-view-template");
                        const clone = templ.content.cloneNode(true);
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        if (data.data.product_gallary != null && data.data.product_gallary != 'null' && data
                            .data.product_gallary != '') {
                            if (data.data.product_gallary.detail != null && data.data.product_gallary.detail !=
                                'null' && data.data.product_gallary.detail != '') {
                                clone.querySelector(".quick-view-image").setAttribute('src', data.data
                                    .product_gallary.detail[1].gallary_path);
                            }
                        }
                        if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
                            clone.querySelector(".quick-view-image").setAttribute('alt', data.data.detail[0]
                                .title);
                        }
                        if (data.data.category != null && data.data.category != 'null' && data.data.category !=
                            '') {
                            for (j = 0; j < data.data.category.length; j++) {
                                if (data.data.category[j].category_detail != null && data.data.category[j]
                                    .category_detail != 'null' && data.data.category[j].category_detail != '') {
                                    if (data.data.category[j].category_detail.detail != null && data.data
                                        .category[j].category_detail.detail != 'null' && data.data.category[j]
                                        .category_detail.detail != '') {
                                        clone.querySelector(".quick-view-categories").innerHTML =
                                            '<li><a href="javascript:void(0)">' + data.data.category[j]
                                            .category_detail.detail[0]
                                            .name + '</a></li>';
                                    }
                                }
                            }
                        }
                        if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
                            clone.querySelector(".quick-view-product-name").innerHTML = data.data.detail[0]
                                .title;
                            clone.querySelector(".quick-view-desc").innerHTML = data.data.detail[0].desc.replace(/<\/?[^>]+>/gi, '').substring(0,250)
                        }
                        clone.querySelector(".quick-view-product-id").innerHTML = data.data.product_id;

                        if (data.data.product_type == 'simple') {
                            if (data.data.product_discount_price == '' || data.data.product_discount_price ==
                                null || data.data.product_discount_price == 'null') {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data
                                    .product_price_symbol + '</ins>';
                            } else {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data.product_discount_price + '</ins> <del>' + data.data
                                    .product_price_symbol +
                                    '</del>';
                            }

                            clone.querySelector(".quick-view-add-to-cart").setAttribute('onclick',
                                'addToCart(this)');
                            clone.querySelector(".quick-view-add-to-cart").setAttribute('data-id', data.data
                                .product_id);
                        } else {
                            if (data.data.product_combination != null && data.data.product_combination !=
                                'null' && data.data.product_combination != '') {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data
                                    .product_combination[0].product_price_symbol + '</ins>';
                            }
                            clone.querySelector(".quick-view-qty").classList.add('d-none');
                            clone.querySelector(".quick-view-add-to-cart").setAttribute('href', '/product/' +
                                data
                                .data.product_id + '/' + data
                                .data.product_slug);
                            clone.querySelector(".quick-view-add-to-cart").innerHTML = 'View Detail';
                        }
                        $(".quick-view-modal-show").html('');
                        $(".quick-view-modal-show").append(clone);
                    }
                },
                error: function(data) {},
            });
        }


        function addToCart(input, is_sample = 0) {
            product_type = $.trim($(input).attr('data-type'));
            product_id = $.trim($(input).attr('data-id'));
            product_combination_id = '';
            if (product_type == 'variable') {
                if ($.trim($("#product_combination_id").val()) == '' || $.trim($("#product_combination_id").val()) ==
                    'null') {
                    toastr.error("{{ trans('response.select-combination') }}")
                    return;
                }
                product_combination_id = $("#product_combination_id").val();
            }

            qty = $.trim($("#quantity-input").val());
            if (qty == '' || qty == 'undefined' || qty == null) {
                qty = 1;
            }
            if(is_sample == 1) qty = 1;
            addToCartFun(product_id, product_combination_id, cartSession, qty, is_sample);
        }

        function addToCartFun(product_id, product_combination_id, cartSession, qty, is_sample) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&product_id=' + product_id +
                    '&qty=' + qty + '&product_combination_id=' + product_combination_id;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/store?session_id=' + cartSession + '&product_id=' +
                    product_id + '&qty=' + qty + '&product_combination_id=' + product_combination_id;
            }
            if(is_sample){
                url += '&is_sample=1'; 
            }
            $.ajax({
                type: 'post',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (loggedIn != '1') {
                            localStorage.setItem("cartSession", data.data.session);
                            console.dir(data);
                            menuCart(data.data.session);
                        } else {
                            menuCart('');
                        }
                        toastr.success('{{ trans('response.add-to-cart-success') }}')
                    } else if (data.status == 'Error') {

                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    if (data.responseJSON.status == 'Error') {
                        // toastr.error(data.responseJSON.message);
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }

                },
            });
        }

        function menuCart(cartSession) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&currency=' + localStorage
                    .getItem("currency");
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/get?session_id=' + cartSession + '&currency=' +
                    localStorage.getItem("currency");
            }
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".top-cart-product-show").html('');
                        const templ = document.getElementById("top-cart-product-template");
                        total_price = 0;
                        currrency = '';
                        const cartData = data.data;
                        cartData.forEach(function(cartItem){
                            const clone = templ.content.cloneNode(true);
                            $(".product-card-price").html(cartItem.product_price_symbol);
                            const imagePath = cartItem.product_combination.media === null ? cartItem.product_gallary.detail[0].gallary_path : cartItem.product_combination.media.detail[0].path;
                            clone.querySelector(".top-cart-product-image").setAttribute('src',imagePath);
                            clone.querySelector(".top-cart-product-image").setAttribute('alt',cartItem.product_detail[0].title);
                            const itemName = cartItem.product_detail[0].title;
                            clone.querySelector(".top-cart-product-name").innerHTML = itemName;

                            // const discount_price = cartItem.discount_price > 0 ? cartItem.discount_price : cartItem.price;
                            const price = cartItem.is_sample ==1 ? cartItem.product_combination.sample_price : cartItem.product_combination.price;
                            var qty = cartItem.is_sample == 1 ? "Sample" : cartItem.qty;

                            if (cartItem.currency.symbol_position == 'left') {
                                clone.querySelector(".top-cart-product-qty-amount").innerHTML = qty + 
                                    ' x ' + cartItem.currency.code + price;
                                
                            } else {
                                clone.querySelector(".top-cart-product-qty-amount").innerHTML = qty + 
                                ' x ' + price + cartItem.currency.code +
                                    '  <i class="fas fa-trash" data-id=' + cartItem
                                    .product_id + ' data-combination-id=' + cartItem.product_combination_id +
                                    '  onclick="removeCartItem(this)"></i>';
                            }
                            clone.querySelector('.item-remove').innerHTML =  '<i class="fas fa-trash"  data-id=' + cartItem
                                    .product_id + ' data-combination-id=' + cartItem.product_combination_id +
                                    ' onclick="removeCartItem(this)"></i>'

                            total_price = total_price + (price*cartItem.qty);


                            $(".top-cart-product-show").append(clone);

                        })
                        
                        // if (currrency != '' && currrency != 'null' && currrency != null) {
                        //     if (currrency.symbol_position == 'left') {
                        //         total_price = currrency.code + total_price;
                        //     } else {
                        //         total_price = total_price + currrency.code;
                        //     }
                        // }

                        total_price = `$${total_price}`;

                        if (data.data.length > 0) {
                            const temp1 = document.getElementById("top-cart-product-total-template");
                            const clone1 = temp1.content.cloneNode(true);
                            clone1.querySelector(".top-cart-product-total").innerHTML = total_price;
                            $(".top-cart-product-show").append(clone1);
                            $(".total-menu-cart-product-count").html(data.data.length);
                        } else {
                            $(".top-cart-product-show").html('{{ trans('lables.header-emptycart') }}');
                        }
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }


        $(document).on('click', '.quantity-plus', function() {
            var quantity = $('#quantity-input').val();
            $('#quantity-input').val(parseInt(quantity) + 1);
        })

        $(document).on('click', '.quantity-minus', function() {
            var quantity = $('#quantity-input').val();
            if (quantity > 1)
                $('#quantity-input').val(parseInt(quantity) - 1);
        });

        $(".language-default").click(function(e) {
            e.preventDefault();
            languageId = $(this).attr('data-id');
            languageName = $(this).attr('data-name');
            localStorage.setItem("languageId", languageId);
            localStorage.setItem("languageName", languageName);
            $(".language-default-name").html(languageName);
            var href = $(this).attr('href');
            window.location.href = href;
        });

        $(".mobile-language").change(function(e) {
            e.preventDefault();
            languageId = $(this).val();
            languageName = $(".mobile-language option:selected").text();
            localStorage.setItem("languageId", languageId);
            localStorage.setItem("languageName", languageName);
            var href = $(".mobile-language option:selected").attr('data-link');
            window.location.href = href;
        });


        $('.cat-dropdown').click(function() {
            var category_id = $(this).attr('data-id');
            var category_name = $(this).attr('data-name');
            $('.selected_category').attr('data-id', category_id);
            $('.selected_category').html(category_name);
        });

        $('#search_button').click(function(e) {
            e.preventDefault();
            var searchInput = $('#search-input').val();
            if (searchInput == "") {
                toastr.error("{{ trans('search-input-empty') }}")
            } else {
                var url = "{{ url('/shop') }}" + '?search=' + searchInput;
                var catgory_id = $('.selected_category').attr('data-id');
                if (catgory_id != '' && catgory_id !== undefined)
                    url += "&category=" + catgory_id;
                window.location.href = url;
            }
        })


        $(".selected-currency").click(function(e) {
            e.preventDefault();
            currencyId = $(this).attr('data-id');
            currencycode = $(this).attr('data-code');
            localStorage.setItem("currency", currencyId);
            localStorage.setItem("currencyCode", currencycode);
            $("#selected-currency").html(currencycode);
            var href = $(this).attr('href');
            location.reload();
        });



        $(".currency").change(function(e) {
            e.preventDefault();
            lcurrencyId = $(this).attr('data-id');
            currencycode = $(this).attr('data-code');
            localStorage.setItem("currency", currencyId);
            localStorage.setItem("currencyCode", currencycode);
            location.reload();
        });

        function logout_action(){
            localStorage.removeItem("customerToken");
            localStorage.removeItem("customerHash");
            localStorage.removeItem("customerLoggedin");
            localStorage.removeItem("customerId");
            localStorage.removeItem("customerFname");
            localStorage.removeItem("customerLname");
            localStorage.removeItem("cartSession", '');
            localStorage.removeItem("customerEmail");
            localStorage.removeItem("customerFname");
            localStorage.removeItem("customerLname");
            location.reload();
        }

        $('.log_out').click(function() {
            url = "{{ url('') }}" + '/api/client/customer_logout';

            $.ajax({
                type: 'post',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                   logout_action();
                },
                error: function(data) {
                    logout_action();
                },
            });
        });

        function cartItem(cartSession) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&language_id=' + languageId +
                    '&currency=' + localStorage.getItem("currency");
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/get?session_id=' + cartSession + '&language_id=' +
                    languageId + '&currency=' + localStorage.getItem("currency");
            }

            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $("#cartItem-product-show").html('');
                        const templ = document.getElementById("cartItem-Template");
                        total_price = 0;
                        const cartData = data.data;
                        $(".cart-item-count").html(`(${cartData.length} items)`);
                        cartData.forEach(function(cartItem, i){
                            console.log("Cart Item:", cartItem);
                            var sum = 0;
                            $("#totalItems").val(i + 1);
                            const clone = templ.content.cloneNode(true);
                            const cartItemDetail = cartItem.product_combination;
                            $(".product-card-price").html(cartItem.product_price_symbol);
                            const imagePath = cartItem.product_combination.media === null ? cartItem.product_gallary.detail[0].gallary_path : cartItem.product_combination.media.detail[0].path;
                            clone.querySelector(".cartItem-image").setAttribute('src',imagePath);
                            clone.querySelector(".cartItem-image").setAttribute('alt',cartItem.product_detail[0].title);
                            const itemName = cartItemDetail.name ? cartItemDetail.name : cartItem.product_detail[0].title;
                            clone.querySelector(".cartItem-name").innerHTML = itemName;

                            clone.querySelector(".cart-item-boxsize").innerHTML = `${cartItemDetail.box_size}ps`;
                            clone.querySelector(".cart-item-size").innerHTML = `${parseInt(cartItemDetail.width)}" x ${parseInt(cartItemDetail.length)}"`;
                            clone.querySelector(".cart-item-color").innerHTML = `${cartItemDetail.color.color}`;
                            clone.querySelector(".cart-item-finish").innerHTML = `${cartItemDetail.finish.name}`;
                            clone.querySelector(".cart-item-look").innerHTML = `${cartItemDetail.look.name}`;
                            clone.querySelector(".cart-item-shape").innerHTML = `${cartItemDetail.shape.name}`;
                            

                            // const discount_price = cartItem.discount_price > 0 ? cartItem.discount_price : cartItem.price;
                            const price = cartItem.product_combination.price;
                            
                            if (cartItem.currency.symbol_position == 'left') {
                                if(cartItem.is_sample == 1) {
                                    sum = +cartItem.product_combination.sample_price;
                                    clone.querySelector(".cartItem-total").innerHTML = cartItem.currency.code + cartItem.product_combination.sample_price;
                                    clone.querySelector(".cartItem-price").innerHTML = "Requested Sample";
                                } else {
                                    sum = +cartItem.qty * + price;
                                    clone.querySelector(".cartItem-total").innerHTML = cartItem.currency.code +  sum.toFixed(2);
                                    clone.querySelector(".cartItem-price").innerHTML = cartItem.currency.code +  price;
                                }
                                
                            } else {
                                if(cartItem.is_sample == 1) {
                                    sum = +cartItem.product_combination.sample_price;
                                    clone.querySelector(".cartItem-total").innerHTML = sum.toFixed(2) + ' ' + cartItem.currency.code;
                                    clone.querySelector(".cartItem-price").innerHTML = "Requested Sample";
                                } else {
                                    sum = +cartItem.qty * + price;
                                    clone.querySelector(".cartItem-total").innerHTML = sum.toFixed(2) + ' ' + cartItem.currency.code;
                                    clone.querySelector(".cartItem-price").innerHTML = price + ' ' + cartItem.currency.code;
                                }
                            }

                            total_price = total_price + sum;
                            clone.querySelector(".cartItem-qty").value = +cartItem.qty;
                            if(cartItem.is_sample == 1){
                                // clone.querySelector(".cartItem-qty").
                                $(clone).find(".item-quantity").remove();
                            } else {
                                clone.querySelector(".cartItem-qty").setAttribute('id', 'quantity' + i);
                                clone.querySelector(".cartItem-qty-1").setAttribute('value', 'quantity' + i);
                                clone.querySelector(".cartItem-qty-2").setAttribute('value', 'quantity' + i);
                                clone.querySelector(".cartItem-qty-1").setAttribute('data-field', i);
                                clone.querySelector(".cartItem-qty-2").setAttribute('data-field', i);
                            }
                            
                            
                            // if ($.trim(cartItem.category_detail[0].category_detail) != '' && $.trim(cartItem.category_detail[0].category_detail) != 'null' && $.trim(cartItem.category_detail[0].category_detail) != null) {
                            //     clone.querySelector(".cartItem-category-name").innerHTML = cartItem.category_detail[0].category_detail.detail[0].name;
                            // }
                            clone.querySelector(".cartItem-remove").setAttribute('data-id', cartItem.product_id);
                            clone.querySelector(".cartItem-remove").setAttribute('data-combination-id', cartItem.product_combination_id);
                            clone.querySelector(".cartItem-remove").setAttribute('onclick','removeCartItem(this)');

                            clone.querySelector(".cartItem-row").setAttribute('product_combination_id', cartItem.product_combination_id);
                            clone.querySelector(".cartItem-row").setAttribute('product_id', cartItem.product_id);
                            clone.querySelector(".cartItem-row").setAttribute('product_type', cartItem.product_type);

                            $("#cartItem-product-show").append(clone);

                            const temp1 = document.getElementById("cartItem-grandtotal-template");
                            const clone1 = temp1.content.cloneNode(true);
                            if (cartItem.currency != '' && cartItem.currency != 'null' && cartItem.currency != null) {
                                if (cartItem.currency.symbol_position == 'left') {
                                    clone1.querySelector(".caritem-subtotal").innerHTML = cartItem.currency.code  + total_price.toFixed(2);
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price', total_price.toFixed(2));
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price-symbol', cartItem.currency.code + total_price.toFixed(2));
                                    clone1.querySelector(".caritem-grandtotal").innerHTML = cartItem.currency.code + total_price.toFixed(2);
                                } else {
                                    clone1.querySelector(".caritem-subtotal").innerHTML = total_price.toFixed(2) + cartItem.currency.code;
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price', total_price.toFixed(2));
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price-symbol', cartItem.currency.code + total_price.toFixed(2));
                                    clone1.querySelector(".caritem-grandtotal").innerHTML = total_price.toFixed(2) + cartItem.currency.code;
                                }
                            }
                            $("#cartItem-grandtotal-product-show").html('');
                            $("#cartItem-grandtotal-product-show").append(clone1);
                        })

                        couponCart = $.trim(localStorage.getItem("couponCart"));
                        if (couponCart != 'null' && couponCart != '') {
                            $("#coupon_code").val(couponCart);
                            couponCartItem();
                        }

                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function removeCartItem(input) {

            product_id = $.trim($(input).attr('data-id'));
            product_combination_id = $.trim($(input).attr('data-combination-id'));
            if (product_combination_id == null || product_combination_id == 'null') {
                product_combination_id = '';
            }

            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart/delete?session_id=' + cartSession + '&product_id=' +
                    product_id +
                    '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/delete?session_id=' + cartSession + '&product_id=' +
                    product_id + '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            }

            $.ajax({
                type: 'DELETE',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(input).closest('tr').remove();
                        cartItem(cartSession);
                        menuCart(cartSession);
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function renderProjectOptions(projects, parent = ""){
            if(projects == null || projects.length == 0) return;

            projects.map(function(project){
                var title = project.project.title;
                if(parent !== "") title = parent + "/" + title;
                var id = project.project.id;
                var option = "<option value='"+ id +"'>" + title + "</option>";
                $("#add_to_project_select_project").append(option);
                $("#create_projcet_parent_id").append(option);
                $("#clone_product_project_select").append(option);
                if(project.children.length){
                    renderProjectOptions(project.children, title);
                }
            })

        }

        function getAllProject(){
            $.ajax({
                type: "POST",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                url: "{{ route('projects.getAll')}}",
                dataType: "json",
                data:{
                    customerId: customerId
                },
                success: function(res){
                    var projects = res.projects;
                    renderProjectOptions(projects);
                    var projectCount = projects.length;
                    $(".projects-count").text(projectCount);
                }
            })
        }


        $(document).ready(function(){
            // $("#add_to_project_select_project").dropdown({
            //     titleText:'Please select a project',
            // });
            $(".select2").select2({
                tags: true
            })

            // Create Project Button
            $("#create_project_btn").on("click", function(){
                var title = $("#create_project_project_name").val();
                var parent_id = $("#create_projcet_parent_id").val();
                var expire_at = $("#create_project_expire_at").val();
                if(title === "" || expire_at === "" ){
                    return ;
                }

                $.ajax({
                    headers: {
                        'Authorization': 'Bearer ' + customerToken,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                        clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                    },
                    type: "post",
                    url: "/api/client/projects",
                    data: {
                        title: title,
                        parent_id: parent_id,
                        expire_at: expire_at
                    },
                    success: function(res){
                        if(res.status == "success"){
                            var defaultOption = "<option value='0'>Select a project</option>";
                            $("#add_to_project_select_project").html(defaultOption);
                            $("#create_projcet_parent_id").html(defaultOption);
                            getAllProject();
                            $("#close_create_project_modal").trigger("click");
                        } else if( res.status == "error"){
                            if(res.error == "auth_error"){
                                alert("Please login first!");
                            }
                        }
                    }
                })

            });

            $("#add_to_project_btn").on("click", function(){
                var project_id = $("#add_to_project_select_project").val();
                var tags = $("#add_to_project_select_tag").val();
                var product_id = $("#add_to_project_product_id").val();

                if(product_id === "" || project_id === "") return;

                $.ajax({
                    type: "POST",
                    headers: {
                        'Authorization': 'Bearer ' + customerToken,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                        clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                    },
                    url: "{{ route('projects.addProduct')}}",
                    data: {
                        product_id : product_id,
                        project_id: project_id,
                        tags: tags
                    },
                    success: function(res){
                        alert("Product added successful!");
                        $("#close_add_to_project_btn").trigger("click");
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            })

            // Get all Projects
            getAllProject();
        })

        function showAddToProjectModal(input){
            var pid = $(input).data('id');
            $("#add_to_project_product_id").val(pid);
        }

        function showAddToCartModal(input){
            var product_id = $(input).data("id");
            var template = document.getElementById("shopping-cart-modal-item-content-template");
            var url = "{{ url('') }}" + '/api/client/products/' + product_id +
            '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
            $.ajax({
                type: "get",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                url: url,
                success: function(res){
                    const variations = res.data.variations;
                    $(".variation-container").remove();
                    if(variations){
                        variations.forEach(function(v){
                            var clone = template.content.cloneNode(true);
                            $(clone).find(".variation-container").attr("data-product-id", v.product_id);
                            $(clone).find(".variation-container").attr("data-id", v.id);
                            $(clone).find(".variation-container").attr("data-type", 'variable');
                            var variationTitleArray = [];
                            if(v.color) variationTitleArray.push(v.color.color);
                            if(v.shade) variationTitleArray.push(v.shade.name);
                            if(v.finish) variationTitleArray.push(v.finish.name);
                            if(v.look) variationTitleArray.push(v.look.name);
                            if(v.shape) variationTitleArray.push(v.shape.name);
                            $(clone).find(".variation-title").text(variationTitleArray.join("/"));
                            $(clone).find(".variation-price").text(`$${v.price}`);
                            if(v.media){
                                $(clone).find(".variation-image").attr("src", v.media.detail[2].path)
                            } else {
                                $(clone).find(".variation-image").attr("src", res.data.product_gallary.detail[2].gallary_path);
                            }
                            $("#add_to_cart_modal_content").append(clone);
                        });

                        $(".variation-checkbox").unbind("change").on("change", function(e){
                            var isChecked = e.target.checked;
                            if(isChecked){
                                $(this).parents(".variation-container").addClass("variation-selected");
                            } else {
                                $(this).parents(".variation-container").removeClass("variation-selected");
                            }
                        })

                    }
                }
                
            })
            
        }

        $("#add_to_shopping_cart_btn").on("click", function(){
            var $selectedItems = $("#add_to_cart_modal_content").find(".variation-selected");
            if($selectedItems.length === 0) return;

            $selectedItems.map(function(index, item){
                var product_type = $(item).data("type");
                var product_id = $(item).data('product-id');
                var variation_id = $(item).data("id");
                var qty = $(item).find(".qty").val();
                if(qty == 0) return;
                addToCartFun(product_id,  variation_id, cartSession, qty);
            });

            $("#close_to_shopping_cart_btn").trigger("click");
        })

    </script>

    @yield('script')
</body>

</html>
