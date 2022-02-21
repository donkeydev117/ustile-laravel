@extends('layouts.master')
@section('content')
<style>
    .variation_active {
        border: 1px solid;
    }

    .price-active {
        border: 1px solid;
    }
    .product-hero{
        height: 470px;
        position: relative;

    }
    .product-summary-container{
        position: absolute;
        width : 100%;
        bottom: 10px;
        color: #fff
    }
    .product-title{
        font-size: 48px;
        color: #fff;
        font-weight: bold;
    }

    .product-brand{
        margin-left: 10px;
    }
    .variation-image img{
        width: 100%;
    }
    .product-variation-card-container{
        display: block;
        padding: 5px;
        background: #fff;
        border-radius: 2px;
        box-shadow: 0px 1px 2px 0px #888;
    }
    .variation-color-shape{
        font-size: 18px;
        font-family: "Montserrat-Bold", sans-serif;
        color: #8b4d16;
    }

    .variatin-finish-look{
        font-size: 12px;
        color: #cd2378;
    }
    .variation-size{

    }
</style>
{{-- <div class="container-fuild">
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('lables.bread-crumb-home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('lables.bread-product-page') }}</li>
            </ol>
        </div>
    </nav>
</div> --}}

<section class="pro-content pt-0">
    <div class="product-hero">
        <div class="product-summary-container">
            <div class="container">
                <span class="product-title"></span>
                <span class="product-brand"></span>
                <span class="product-material"></span>
                <ul class="product-application">
    
                </ul>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="p-4">
            <p class="product-description"></p>
        </div>
        <div class="page-heading-title">
            <h2>Variations</h2>
        </div>
    </div>

    <section class="product-page container">
        <div class="row " id="variations-container">

        </div>
    </section>
    @include('includes.productdetail.related-product-section');
</section>

@include('includes.productdetail.product-template')
@include('includes.productdetail.variation-card')

@include(isset(getSetting()['card_style']) ?
'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")

<input type="hidden" id="product_id" value="{{ $product }}" />
@endsection


@section('script')
<script>
    var attribute_id = [];
    var attribute = [];
    var variation_id = [];
    var variation = [];
    $(document).ready(function() {
        fetchProduct();
        fetchRelatedProduct();
    });

    languageId = localStorage.getItem("languageId");
    if (languageId == null || languageId == 'null') {
        localStorage.setItem("languageId", '1');
        $(".language-default-name").html('Endlish');
        localStorage.setItem("languageName", 'English');
        languageId = 1;
    }

    customerToken = $.trim(localStorage.getItem("customerToken"));

    var productImagePath;

    function fetchProduct() {
        var url = "{{ url('') }}" + '/api/client/products/' + "{{ $product }}" +
            '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
        var appendTo = '.product-page';
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    var product = data.data;
                    console.log("product:", product);
                    var product_gallary = product.product_gallary;
                    if(product_gallary){
                        productImagePath = product_gallary.detail[0].gallary_path;
                        $(".product-hero").css("background-image", `url(${product_gallary.detail[0].gallary_path})`);
                    } else {
                        // Default image
                    }
                   

                    $(".product-title").text(product.detail[0].title);
                    $(".product-material").text(product.material.name);
                    $(".product-brand").text(product.product_brand.brand_name);
                    var application = product.application.split(",");
                    application.forEach(function(item){
                        var element = `<li>${item}</li>`;
                        $(".product-application").append(element);
                    })

                    if(product.made_in_usa == "1"){
                        var element = `<span class="badge badge-secondary">Made In USA</span>`;
                        $(".product-summary-container").find(".container").append(element);
                    }

                    if(product.is_featured == "1"){
                        var element = `<span class="badge badge-primary ml-2">Featured</span>`;
                        $(".product-summary-container").find(".container").append(element);
                    }
                    const shipping_status = product.shipping_status;
                    shipping_status.forEach(function(item, index){
                        $(".product-summary-container").find(".container").append(`<span class='badge badge-info ml-2'>${item.status.name}</span>`);
                    })

                    $(".product-description").text(product.detail[0].desc);
                    var variations = product.variations;
                    var temp = document.getElementById("product-variation-card-template");
                    variations.forEach(function(v){
                        var clone = temp.content.cloneNode(true);
                        var variationPath = `/product/${product.product_id}/${product.product_slug}/variation/${v.id}`;
                        $(clone).find(".product-variation-card-container").prop("href", variationPath);
                        var imagePath = v.media ? v.media.detail[1].path : productImagePath;
                        $(clone).find(".variation-image").find('img').prop('src', imagePath);
                        var colorShape = `${v.color.color}-${v.shape.name}`;
                        $(clone).find('.variation-color-shape').text(colorShape);
                        var finishLook = `${v.finish.name}-${v.look.name}`;
                        $(clone).find('.variatin-finish-look').text(finishLook);

                        var size = `${parseInt(v.width)}" x ${parseInt(v.length)}" x ${parseInt(v.box_size)}ps`;
                        $(clone).find('.variation-size').text(size);
                        var $variatinContainer = $("<div class='col-sm-6 col-md-4 col-lg-3'></div>");
                        $variatinContainer.append(clone);

                        $("#variations-container").append($variatinContainer);

                    })

                }
            },
            error: function(data) {},
        });
    }


    function fetchRelatedProduct() {
        var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
        var appendTo = 'related';
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {

                    const templ = document.getElementById("product-card-template");
                    templ.prepend('<div class="product-carousel-js">');
                    templ.append('</div>');
                    for (i = 0; i < data.data.length; i++) {
                        const clone = templ.content.cloneNode(true);
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        clone.querySelector(".wishlist-icon").setAttribute('data-id', data.data[i]
                            .product_id);
                        clone.querySelector(".wishlist-icon").setAttribute('onclick', 'addWishlist(this)');
                        clone.querySelector(".wishlist-icon").setAttribute('data-type', data.data[i]
                            .product_type);
                        clone.querySelector(".compare-icon").setAttribute('data-id', data.data[i]
                            .product_id);
                        clone.querySelector(".compare-icon").setAttribute('data-type', data.data[i]
                            .product_type);
                        clone.querySelector(".compare-icon").setAttribute('onclick', 'addCompare(this)');
                        clone.querySelector(".quick-view-icon").setAttribute('data-id', data.data[i]
                            .product_id);
                        clone.querySelector(".quick-view-icon").setAttribute('data-type', data.data[i]
                            .product_type);
                        clone.querySelector(".quick-view-icon").setAttribute('onclick', 'quiclViewData(this)');

                        if (data.data[i].product_gallary != null) {
                            if (data.data[i].product_gallary.detail != null) {
                                clone.querySelector(".product-card-image").setAttribute('src', data.data[i]
                                    .product_gallary.detail[1].gallary_path);
                            }
                        }
                        if (data.data[i].detail != null) {
                            clone.querySelector(".product-card-image").setAttribute('alt', data.data[i]
                                .detail[0].title);
                        }
                        if (data.data[i].category != null) {
                            if (data.data[i].category[0].category_detail != null) {
                                if (data.data[i].category[0].category_detail.detail != null) {
                                    clone.querySelector(".product-card-category").innerHTML = data.data[i]
                                        .category[0].category_detail.detail[0].name;
                                }
                            }
                        }
                        if (data.data[i].detail != null) {
                            clone.querySelector(".product-card-name").innerHTML = data.data[i].detail[0]
                                .title;
                            clone.querySelector(".product-card-name").setAttribute('href', '/product/' + data
                                    .data[i].product_id+'/'+data
                                    .data[i].product_slug);
                                    var desc = data.data[i].detail[0].desc;
                            clone.querySelector(".product-card-desc").innerHTML = desc.substring(0, 50);
                        }

                        if (data.data[i].product_type == 'simple') {
                                if (data.data[i].product_discount_price == '' || data.data[i]
                                    .product_discount_price == null || data.data[i].product_discount_price ==
                                    'null') {
                                    clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                        .product_price_symbol;
                                } else {
                                    clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                        .product_price_symbol + '<span>' +data.data[i].product_discount_price_symbol +'</span>';
                                }
                        } else {
                            if (data.data[i].product_combination != null) {
                                clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                    .product_combination[0].product_price_symbol;
                            }
                        }

                        clone.querySelector(".product-card-link").setAttribute('href', '/product/' + data
                                    .data[i].product_id+'/'+data
                                    .data[i].product_slug);
                        $("." + appendTo).append(clone);
                    }
                    getSliderSettings(appendTo);
                }
            },
            error: function(data) {},
        });
    }


    // $(document).on('click', '.variation_list_item', function() {
    //     var variation_name = $(this).attr('data-variation-name');
    //     var attribute_name = $(this).attr('data-attribute-name').split(' ').join('_');

    //     $('.attribute_' + attribute_name + '_div').each(function() {
    //         $('.attribute_' + attribute_name + '_div').removeClass("variation_active");
    //     })

    //     $('.' + variation_name + '-' + attribute_name).addClass("variation_active");

    //     if (attribute_id.indexOf($(this).attr('data-attribute-id')) === -1) {
    //         attribute_id.push($(this).attr('data-attribute-id'));
    //         attribute.push($(this).attr('data-attribute-name'));
    //         variation_id.push($(this).attr('data-variation-id'));
    //         variation.push($(this).attr('data-variation-name'));

    //     } else {

    //         var index = attribute_id.indexOf($(this).attr('data-attribute-id'));
    //         if ($(this).attr('data-variation-id') == "") {
    //             attribute_id.splice(index, 1);
    //             variation_id.splice(index, 1);
    //             attribute.splice(index, 1);
    //             variation.splice(index, 1);
    //         } else {
    //             attribute_id[index] = $(this).attr('data-attribute-id');
    //             variation_id[index] = $(this).attr('data-variation-id');
    //             attribute[index] = $(this).attr('data-attribute-name');
    //             variation[index] = $(this).attr('data-variation-name');
    //         }

    //     }
    //     var url = "{{ url('') }}" + '/api/client/products/{{ $product }}?getCategory=1&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //             clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
    //             clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
    //         },
    //         beforeSend: function() {},
    //         success: function(data) {
    //             if (data.status == 'Success') {
    //                 for (i = 0; i < data.data.product_combination.length; i++) {
    //                     p = 0;
    //                     not_combination = 0;
    //                     product_combination_id = price = gallary = '';
    //                     variation_array = new Array();
    //                     for (k = 0; k < data.data.product_combination[i].combination.length; k++) {
    //                         variation_array[p] = data.data.product_combination[i].combination[k].variation_id;
    //                         ++p;
    //                     }
    //                     if (variation_array.length == variation_id.length) {
    //                         console.log(variation_array);
    //                         console.log(variation_id);
    //                         for (m = 0; m < variation_id.length; m++) {
    //                             if (jQuery.inArray(parseInt(variation_id[m]), variation_array) == -1) {
    //                                 not_combination = 1;
    //                             }
    //                         }
    //                     } else {
    //                         not_combination = 1;
    //                     }

    //                     if (not_combination == 0) {
    //                         product_combination_id = data.data.product_combination[i].product_combination_id;
    //                         $("#product_combination_id").val(product_combination_id);
    //                         price = data.data.product_combination[i].product_price_symbol;
    //                         $(".product-card-price").html(price);

    //                         if (data.data.product_combination[i].gallary != null) {
    //                             gallary = data.data.product_combination[i].gallary.gallary_name;
    //                             var image_list_link = "";
    //                             var image_list = "";

    //                             image_list_link = '<a class="" href="/gallary/large' + data.data.product_combination[i].gallary.gallary_name + '" title="Lorem ipsum dolor sit amet"><img class="product-detail-section-image" src="/gallary/large' + data.data.product_combination[i].gallary.gallary_name + '" alt="Zoom Image" /></a>'


    //                             image_list = '<div class=""><img class="product-detail-section-image" src="/gallary/thumbnail' + data.data.product_combination[i].gallary.gallary_name + '" alt="Zoom Image"/></div>';

    //                             $("#image-"+data.data.product_combination[i].product_combination_id).trigger('click');

    //                             // $(".slider-for").removeClass('slick-initialized slick-slider');
    //                             // $(".slider-for").html(image_list_link);
    //                             // $(".slider-nav").html(image_list);
    //                         }
    //                         return;
    //                     } else {}
    //                 }

    //                 // slideInital();
    //             }
    //         },
    //         error: function(data) {},
    //     });

    // })

    // function productReview() {
    //     rating = $("input[name=rating]").val();
    //     comment = $("#comment").val();
    //     title = $("#title").val();
    //     if(rating == ''){
    //         toastr.error('{{ trans("select-ratings") }}');
    //         return;
    //     }

    //     var url = "{{ url('') }}" + '/api/client/review?product_id={{ $product }}&comment=' + comment + '&rating=' + rating +'&title='+title;
    //     var appendTo = 'related';
    //     $.ajax({
    //         type: 'post',
    //         url: url,
    //         headers: {
    //             'Authorization': 'Bearer ' + customerToken,
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //             clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
    //             clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
    //         },
    //         beforeSend: function() {},
    //         success: function(data) {
    //             if (data.status == 'Success') {
    //                 toastr.success('{{ trans("rating-saved-successfully") }}');
    //                 $("#comment").val('');
    //                 $("#title").val('');
    //                 getProductReview();
    //             }
    //         },
    //         error: function(data) {
    //             console.log(data);
    //             if (data.status == 422) {
    //                 jQuery.each(data.responseJSON.errors, function(index, item) {
    //                     $("#" + index).parent().find('.invalid-feedback').css('display',
    //                         'block');
    //                     $("#" + index).parent().find('.invalid-feedback').html(item);
    //                 });
    //             }
    //             else if (data.status == 401) {
    //                 toastr.error('{{ trans("response.some_thing_went_wrong") }}');
    //             }
    //         },
    //     });
    // }

    // function getProductReview() {
    //     var url = "{{ url('') }}" + '/api/client/review?product_id={{ $product }}';
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         headers: {
    //             'Authorization': 'Bearer ' + customerToken,
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    //             clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
    //             clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
    //         },
    //         beforeSend: function() {},
    //         success: function(data) {
    //             if (data.status == 'Success') {
    //                 const temp2 = document.getElementById("review-rating-template");
    //                 $("#review-rating-show").html('');
    //                 for (review = 0; review < data.data.length; review++) {
    //                     const clone1 = temp2.content.cloneNode(true);
    //                     clone1.querySelector(".review-comment").innerHTML = data.data[review].comment;
    //                     clone1.querySelector(".review-date").innerHTML = data.data[review].date;
    //                     clone1.querySelector(".review-title").innerHTML = data.data[review].title;
    //                     if (data.data[review].rating == '5') {
    //                         clone1.querySelector(".review-rating5").setAttribute('checked', true);
    //                     } else if (data.data[review].rating == '4') {
    //                         clone1.querySelector(".review-rating4").setAttribute('checked', true);
    //                     } else if (data.data[review].rating == '3') {
    //                         clone1.querySelector(".review-rating3").setAttribute('checked', true);
    //                     } else if (data.data[review].rating == '2') {
    //                         clone1.querySelector(".review-rating2").setAttribute('checked', true);
    //                     } else if (data.data[review].rating == '1') {
    //                         clone1.querySelector(".review-rating1").setAttribute('checked', true);
    //                     }
    //                     $("#review-rating-show").append(clone1);
    //                 }
    //             }
    //         },
    //         error: function(data) {
    //             console.log(data);
    //         },
    //     });
    // }


    // function slideInital() {
    //     // Product SLICK
    //     // $('.slider-show').html('<div class="slider-for"></div><div class="slider-nav"></div>');
    //     // alert();
    //     jQuery('.slider-for').slick({
    //         slidesToShow: 1,
    //         slidesToScroll: 1,
    //         arrows: false,
    //         infinite: false,
    //         draggable: false,
    //         fade: true,
    //         asNavFor: '.slider-nav',
    //         reinit : true
    //     });
    //     jQuery('.slider-nav').slick({
    //         slidesToShow: 3,
    //         slidesToScroll: 1,
    //         asNavFor: '.slider-for',
    //         centerMode: true,
    //         centerPadding: '60px',
    //         dots: false,
    //         arrows: true,
    //         focusOnSelect: true,
    //         reinit : true
    //     });


    //     // Product vertical SLICK
    //     jQuery('.slider-for-vertical').slick({
    //         slidesToShow: 1,
    //         slidesToScroll: 1,
    //         arrows: false,
    //         infinite: false,
    //         draggable: false,
    //         fade: true,
    //         asNavFor: '.slider-nav-vertical'
    //     });
    //     jQuery('.slider-nav-vertical').slick({
    //         dots: false,
    //         arrows: true,
    //         vertical: true,
    //         asNavFor: '.slider-for-vertical',
    //         slidesToShow: 3,
    //         // centerMode: true,
    //         slidesToScroll: 1,
    //         verticalSwiping: true,
    //         focusOnSelect: true
    //     });

    //     jQuery(function() {
    //         // ZOOM
    //         jQuery('.ex1').zoom();

    //     });

    // }
</script>
@endsection
