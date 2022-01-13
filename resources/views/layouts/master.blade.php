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
    <meta name="csrf-token" content="{{ csrf_token() }}">




</head>

<body class="animation-s1 nicescroll {{ $data['direction'] === 'rtl' ? 'bodyrtl' : '' }}">

    <style>
        #addToProjectModal .dropdown-list{
            width: 100% !important;
            height: 100% !important;
        }
        #addToProjectModal .dropdown-menu {
            margin : 0 !important;
            width: 100% !important;
        }
        #addToProjectModal .dropdown-text{
            width: 100% !important
        }
        #addToProjectModal .dropdown-toggle{
            width : 100% !important
        }
        #addToProjectModal .dropdown,
        #addToProjectModal .dropdown-menu-wrapper,
        #addToProjectModal .dropdown-menu-container{
            width: 100% !important;
        }
        #addToProjectModal .dropdown-toggle .dropdown-icon{
            margin-left: 0 !important;

        }
        #addToProjectModal .dropdown-toggle::after{
            content: none !important;
        }
    </style>
  
    @include('extras.preloader')
    @include(isset(getSetting()['header_style']) ? 'includes.headers.header-'.getSetting()['header_style'] :
    'includes.headers.header-style1')


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

    <!-- All custom scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/front/js/jquery.dropdown.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/assets/front/js/jquery-sortable-lists.min.js"></script>
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


        function addToCart(input) {

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
            addToCartFun(product_id, product_combination_id, cartSession, qty);
        }

        function addToCartFun(product_id, product_combination_id, cartSession, qty) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&product_id=' + product_id +
                    '&qty=' + qty + '&product_combination_id=' + product_combination_id;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/store?session_id=' + cartSession + '&product_id=' +
                    product_id + '&qty=' + qty + '&product_combination_id=' + product_combination_id;
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
                    console.log();
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
                        for (i = 0; i < data.data.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k]
                                        .product_combination_id) {
                                        price = data.data[i].combination[k].price;
                                        $(".product-card-price").html(data.data[i].product_price_symbol);

                                        if (data.data[i].combination[k].gallary != null && data.data[i]
                                            .combination[k].gallary != 'null' && data.data[i].combination[k]
                                            .gallary != '') {
                                            clone.querySelector(".top-cart-product-image").setAttribute('src',
                                                '/gallary/' + data.data[i].combination[k].gallary
                                                .gallary_name);
                                            clone.querySelector(".top-cart-product-image").setAttribute('alt',
                                                data.data[i].combination[k].gallary.gallary_name);
                                            name = data.data[i].product_detail[0].title;
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination[loop].length - 1 == loop) {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name;
                                                } else {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name + '-';
                                                }
                                            }
                                            clone.querySelector(".top-cart-product-name").innerHTML = name;
                                        }
                                        k = data.data[i].combination.length;
                                    } else {}
                                }
                            } else {
                                if (data.data[i].product_gallary != null && data.data[i].product_gallary !=
                                    'null' && $.trim(data.data[i].product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && data.data[i]
                                        .product_gallary.detail != 'null' && $.trim(data.data[i].product_gallary
                                            .detail) != '') {
                                        clone.querySelector(".top-cart-product-image").setAttribute('src', data
                                            .data[i].product_gallary.detail[2].gallary_path);
                                    }
                                }
                                if (data.data[i].product_detail != null && data.data[i].product_detail !=
                                    'null' && $.trim(data.data[i].product_detail) != '') {
                                    clone.querySelector(".top-cart-product-image").setAttribute('alt', data
                                        .data[i].product_detail[0].title);
                                    clone.querySelector(".top-cart-product-name").innerHTML = data.data[i]
                                        .product_detail[0].title;
                                }
                            }

                            if (data.data[i].discount_price > 0)
                            {
                                discount_price = data.data[i].discount_price;
                            } else {
                                discount_price = data.data[i].price;
                            }
                            //discount_price = +data.data[i].price - +data.data[i].discount_price;
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    clone.querySelector(".top-cart-product-qty-amount").innerHTML = data.data[i]
                                        .qty + ' x ' + data.data[i].currency.code + ' ' + discount_price +
                                        '     <i class="fas fa-trash"  data-id=' + data.data[i]
                                        .product_id + ' data-combination-id=' + data
                                        .data[i].product_combination_id +
                                        ' onclick="removeCartItem(this)"></i>';
                                } else {
                                    clone.querySelector(".top-cart-product-qty-amount").innerHTML = data.data[i]
                                        .qty + ' x ' + discount_price + ' ' + data.data[i].currency.code +
                                        '  <i class="fas fa-trash" data-id=' + data.data[i]
                                        .product_id + ' data-combination-id=' + data
                                        .data[i].product_combination_id +
                                        '  onclick="removeCartItem(this)"></i>';
                                }
                            }
                            
                            total_price = total_price + (discount_price*data.data[i].qty);

                            $(".top-cart-product-show").append(clone);
                            currrency = data.data[i].currency;
                        }
                        if (currrency != '' && currrency != 'null' && currrency != null) {
                            if (currrency.symbol_position == 'left') {
                                total_price = currrency.code + ' ' + total_price;
                            } else {
                                total_price = total_price + ' ' + currrency.code;
                            }
                        }
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
                    if (data.status == 'Success') {
                        localStorage.removeItem("customerToken");
                        localStorage.removeItem("customerHash");
                        localStorage.removeItem("customerLoggedin");
                        localStorage.removeItem("customerId");
                        localStorage.removeItem("customerFname");
                        localStorage.removeItem("customerLname");
                        localStorage.removeItem("cartSession", '');
                        localStorage.removeItem("customerEmail",data.data.email);
                        localStorage.removeItem("customerFname",data.data.first_name);
                        localStorage.removeItem("customerLname",data.data.last_name);
                        location.reload();
                    }
                },
                error: function(data) {},
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
                        for (i = 0; i < data.data.length; i++) {
                            $("#totalItems").val(i + 1);
                            const clone = templ.content.cloneNode(true);
                            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k]
                                        .product_combination_id) {
                                        if (data.data[i].combination[k].gallary != null) {
                                            clone.querySelector(".cartItem-image").setAttribute('src',
                                                '/gallary/' + data.data[i].combination[k].gallary
                                                .gallary_name);
                                            clone.querySelector(".cartItem-image").setAttribute('alt', data
                                                .data[i].combination[k].gallary.gallary_name);
                                            name = data.data[i].product_detail[0].title;
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination.length - 1 == loop) {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name;
                                                } else {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name + '-';
                                                }
                                            }
                                            clone.querySelector(".cartItem-name").innerHTML = name;
                                        }
                                        k = data.data[i].combination.length;
                                    } else {}
                                }
                            } else {
                                if (data.data[i].product_gallary != null && $.trim(data.data[i]
                                        .product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && $.trim(data.data[i]
                                            .product_gallary.detail) != '') {
                                        clone.querySelector(".cartItem-image").setAttribute('src', data.data[i]
                                            .product_gallary.detail[2].gallary_path);
                                    }
                                }
                                if (data.data[i].product_detail != null && $.trim(data.data[i]
                                        .product_detail) != '') {
                                    clone.querySelector(".cartItem-image").setAttribute('alt', data.data[i]
                                        .product_detail[0].title);
                                    clone.querySelector(".cartItem-name").innerHTML = data.data[i]
                                        .product_detail[0].title;
                                }
                            }

                            if (data.data[i].discount_price > 0)
                            {
                                discount_price = data.data[i].discount_price;
                            } else {
                                discount_price = data.data[i].price;
                            }
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    sum = +data.data[i].qty * +discount_price;
                                    clone.querySelector(".cartItem-total").innerHTML = data.data[i].currency
                                        .code + ' ' + sum.toFixed(2);
                                    clone.querySelector(".cartItem-price").innerHTML = data.data[i].currency
                                        .code + ' ' +discount_price.toFixed(2);
                                } else {
                                    sum = +data.data[i].qty * +discount_price;
                                    clone.querySelector(".cartItem-total").innerHTML = sum.toFixed(2) + ' ' + data.data[i]
                                        .currency.code;
                                    clone.querySelector(".cartItem-price").innerHTML = discount_price.toFixed(2) + ' ' + data.data[i]
                                        .currency.code;
                                }
                            }
                            else{
                                clone.querySelector(".cartItem-price").innerHTML = discount_price.toFixed(2);
                            }
                            clone.querySelector(".cartItem-qty").value = +data.data[i].qty;
                            clone.querySelector(".cartItem-qty").setAttribute('id', 'quantity' + i);
                            clone.querySelector(".cartItem-qty-1").setAttribute('value', 'quantity' + i);
                            clone.querySelector(".cartItem-qty-2").setAttribute('value', 'quantity' + i);
                            clone.querySelector(".cartItem-qty-1").setAttribute('data-field', i);
                            clone.querySelector(".cartItem-qty-2").setAttribute('data-field', i);

                           
                            total_price = total_price + (discount_price*data.data[i].qty);


                            if ($.trim(data.data[i].category_detail[0].category_detail) != '' && $.trim(data
                                    .data[i].category_detail[0].category_detail) != 'null' && $.trim(data.data[
                                    i].category_detail[0].category_detail) != null) {
                                clone.querySelector(".cartItem-category-name").innerHTML = data.data[i]
                                    .category_detail[0].category_detail.detail[0].name;
                            }
                            clone.querySelector(".cartItem-remove").setAttribute('data-id', data.data[i]
                                .product_id);
                            clone.querySelector(".cartItem-remove").setAttribute('data-combination-id', data
                                .data[i].product_combination_id);
                            clone.querySelector(".cartItem-remove").setAttribute('onclick',
                                'removeCartItem(this)');

                            clone.querySelector(".cartItem-row").setAttribute('product_combination_id', data
                                .data[i].product_combination_id);
                            clone.querySelector(".cartItem-row").setAttribute('product_id', data.data[i]
                                .product_id);
                            clone.querySelector(".cartItem-row").setAttribute('product_type', data.data[i]
                                .product_type);

                            $("#cartItem-product-show").append(clone);

                            const temp1 = document.getElementById("cartItem-grandtotal-template");
                            const clone1 = temp1.content.cloneNode(true);
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    clone1.querySelector(".caritem-subtotal").innerHTML = data.data[i].currency
                                        .code + ' ' + total_price.toFixed(2);
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price',
                                    total_price.toFixed(2));
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price-symbol', data
                                        .data[i].currency.code + ' ' + total_price.toFixed(2));
                                    clone1.querySelector(".caritem-grandtotal").innerHTML = data.data[i]
                                        .currency.code + ' ' + total_price.toFixed(2);
                                } else {
                                    clone1.querySelector(".caritem-subtotal").innerHTML = total_price.toFixed(2) + ' ' +
                                        data.data[i].currency.code;
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price',
                                    total_price.toFixed(2));
                                    clone1.querySelector(".caritem-subtotal").setAttribute('price-symbol', data
                                        .data[i].currency.code + ' ' + total_price.toFixed(2));
                                    clone1.querySelector(".caritem-grandtotal").innerHTML = total_price.toFixed(2) + ' ' +
                                        data.data[i].currency.code;
                                }
                            }
                            $("#cartItem-grandtotal-product-show").html('');
                            $("#cartItem-grandtotal-product-show").append(clone1);
                        }


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
                success: function(res){
                    console.log(res);
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
                        console.log(res);
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

    </script>

    @yield('script')
</body>

</html>
