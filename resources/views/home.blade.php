@extends('layouts.master')
@section('content')

    @include('includes.sliders.slider')

    <style>
        .diamond-section{
            margin-bottom: 4rem;
            padding-bottom: 4rem;
        }
        .diamond{
            transform: rotate(-45deg);
            width: 250px;
            height: 250px;
            position: absolute;
        }
        .diamond img{
            width: 250px;
            height: 250px;
        }
        .diamond-1{
            top: 150px;
            left: 20px;
        }
        .diamond-1 span{
            position: absolute; 
            right:0; 
            top: -25px
        }
        .diamond-2{
            display: flex;
            top: 25px;
            left: 229px;
            width: 200px;
            height: 200px;
        }
        .diamond-2 span {
            text-orientation: mixed; 
            writing-mode: tb-rl;
        }
        .diamond-2 img{
            width: 200px; 
            height: 200px
        }
        .diamond-3 {
            display: flex;
            top: 225px;
            left: 320px;
        }
        .diamond-3 span{
            text-orientation: mixed; 
            writing-mode: tb-rl; 
            position: absolute;
            left: -25px;
        }
        .diamond-4{
            display: flex;
            top: 45px;
            left: 500px;
        }
        .diamond-4 span{
            position: absolute; 
            right:0; 
            top: -25px
        }
        .diamond-5{
            top: 310px;
            left: 635px;
            width: 180px;
            height: 180px;
        }
        .diamond-5 img{
            width:180px;
            height: 180px
        }
        .diamond-6{
            top: 141px;
            left: 784px;
        }
        .diamond-6 span{
            position: absolute; 
            text-orientation: mixed; 
            writing-mode: tb-rl;
        }
        .diamond span{
            font-size: 20px;
            font-weight: 700
        }

        .feature-item p{
            text-align: center; 
            margin-top: 1rem; 
            margin-bottom: 1rem;
            font-size: 24px;
            color: #ef5f4b;
        }
        .feature-item img{
            height: 80px;
        }
        .feature-item a{
            border: 2px solid #ef5f4b; 
            padding: 10px 20px; 
            color: #ef5f4b;
            display: inline-block;
            font-size: 16px;
        }
        .show-room-section{
            background-color: lightgray;
            padding: 4rem 4rem;
            margin-top: 50px;
        }
        .hexagon {
            position: relative;
            width: 240px; 
            height: 138.56px;
            margin: 69.28px 0;
            background-size: auto 277.1281px;
            background-position: center;
        }

        .hexTop,
        .hexBottom {
            position: absolute;
            z-index: 1;
            width: 169.71px;
            height: 169.71px;
            overflow: hidden;
            -webkit-transform: scaleY(0.5774) rotate(-45deg);
            -ms-transform: scaleY(0.5774) rotate(-45deg);
            transform: scaleY(0.5774) rotate(-45deg);
            background: inherit;
            left: 35.15px;
        }

        /*counter transform the bg image on the caps*/
        .hexTop:after,
        .hexBottom:after {
            content: "";
            position: absolute;
            width: 240.0000px;
            height: 138.5640646055102px;
            -webkit-transform:  rotate(45deg) scaleY(1.7321) translateY(-69.2820px);
            -ms-transform:      rotate(45deg) scaleY(1.7321) translateY(-69.2820px);
            transform:          rotate(45deg) scaleY(1.7321) translateY(-69.2820px);
            -webkit-transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            transform-origin: 0 0;
            background: inherit;
        }

        .hexTop {
            top: -84.8528px;
        }

        .hexTop:after {
            background-position: center top;
        }

        .hexBottom {
            bottom: -84.8528px;
        }

        .hexBottom:after {
            background-position: center bottom;
        }

        .hexagon:after {
            content: "";
            position: absolute;
            top: 0.0000px;
            left: 0;
            width: 240.0000px;
            height: 138.5641px;
            z-index: 2;
            background: inherit;
        }

    </style>
    <section class="diamond-section mt-4 pt-4">
        <div class="container pt-4 pb-4 mb-4">
            <h4 class="text-center">Explore Our Tile and Stone Design ideas Gallery</h4>
            <p class="text-center">A Great Place to Get Inspired and Discover New Ideas for Home and Business.</p>
        </div>
        <div class="container" style=" position: relative; height: 500px; ">
            <div class="diamond diamond-1">
                <span>Go Outdoors</span>
                <img src="/gallary/202112103948ONE_COAL.jpeg">
            </div>
            <div class="diamond diamond-2">
                <img src="/gallary/202112103948ONE_COAL.jpeg">
                <span>See Bathrooms</span>
            </div>
            <div class="diamond diamond-3">
                <span>Commercial Tile</span>
                <img src="/gallary/202112103948ONE_COAL.jpeg">
            </div>
            <div class="diamond diamond-4">
                <span>Title Gallery</span>
                <img src="/gallary/202112103948ONE_COAL.jpeg">
            </div>
            <div class="diamond diamond-5">
                <img src="/gallary/202112103948ONE_COAL.jpeg">
                <span>Discover Kitchens</span>
            </div>
            <div class="diamond diamond-6">
                <img src="/gallary/202112103948ONE_COAL.jpeg">
                <span>View Living Space</span>
            </div>
        </div>
    </section>

    <section style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4 text-center feature-item">
                    <img src="{{asset("/images/star-outline.png")}}" />
                    <p>New Items</p>
                    <a href="#">View Collection</a>
                </div>
                <div class="col-12 col-sm-4 text-center feature-item">
                    <img src="{{asset("/images/truck.png")}}" />
                    <p>Ready To Ship</p>
                    <a href="#">View Collection</a>
                </div>
                <div class="col-12 col-sm-4 text-center feature-item">
                    <img src="{{asset("/images/layers.png")}}" />
                    <p>Match Box</p>
                    <a href="#">View Collection</a>
                </div>
            </div>
        </div>
    </section>

    <section class="show-room-section">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <h3>Show Room</h3>
                <p>Lorem Ipsum is simply dummy of the printing and typesetting industry. Lorem Ipsum has been industry's standard dummy text ever since the 1500s, when an unknown printer took a galley unchanged. </p>
            </div>
        </div>
    </section>

    @foreach (homePageBuilderJson() as $template)
        @if (!$template['skip'] && $template['display'])
            @include('sections.home-'.$template['template_postfix'].'-section')
        @endif
    @endforeach


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var url = "{{ url('') }}" +
                '/api/client/products?limit=10&getCategory=1&getDetail=1&language_id=' + languageId +
                '&topSelling=1&currency=' + localStorage.getItem("currency");
            appendTo = 'tab_top_sales';
            fetchProduct(url, appendTo);

            var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' +
                languageId + '&currency=' + localStorage.getItem("currency");
            appendTo = 'tab_special_products';
            fetchProduct(url, appendTo);

            var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' +
                languageId + '&currency=' + localStorage.getItem("currency");
            appendTo = 'tab_most_liked';
            fetchProduct(url, appendTo);

            var url = "{{ url('') }}" +
                '/api/client/products?limit=12&getCategory=1&getDetail=1&language_id=' + languageId +
                '&sortBy=id&sortType=DESC&currency=' + localStorage.getItem("currency");
            appendTo = 'new-arrival';
            fetchProduct(url, appendTo);


            var url = "{{ url('') }}" +
                '/api/client/products?limit=6&getCategory=1&getDetail=1&language_id=' + languageId +
                '&sortBy=id&sortType=DESC&currency=' + localStorage.getItem("currency");
            appendTo = 'weekly-sale';
            fetchProduct(url, appendTo);

            var url = "{{ url('') }}" +
                '/api/client/products?limit=1&getCategory=1&getDetail=1&language_id=' + languageId +
                '&topSelling=1&currency=' + localStorage.getItem("currency");
            appendTo = 'weekly-sale-first-div';
            fetchFeaturedWeeklyProduct(url,appendTo)

            blogNews();
            sliderMedia();
            categorySlider();
            bannerMedia();
            cartSession = $.trim(localStorage.getItem("cartSession"));
            if (cartSession == null || cartSession == 'null') {
                cartSession = '';
            }
            menuCart(cartSession);
        });


        function fetchProduct(url, appendTo) {
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
                            clone.querySelector(".quick-view-icon").setAttribute('onclick',
                                'quiclViewData(this)');
                            
                            rating = '';
                            if(data.data[i].product_rating == 1){
                                rating = '<label class="full fa " for="star1" title="Awesome - 1 stars"></label><label class="full fa " for="star_2" title="Awesome - 2 stars"></label><label class="full fa " for="star_3" title="Awesome - 3 stars"></label><label class="full fa " for="star_4" title="Awesome - 4 stars"></label><label class="full fa active" for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            else if(data.data[i].product_rating == 2){
                                rating = '<label class="full fa " for="star1" title="Awesome - 1 stars"></label><label class="full fa " for="star_2" title="Awesome - 2 stars"></label><label class="full fa " for="star_3" title="Awesome - 3 stars"></label><label class="full fa active" for="star_4" title="Awesome - 4 stars"></label><label class="full fa active" for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            else if(data.data[i].product_rating == 3){
                                rating = '<label class="full fa " for="star1" title="Awesome - 1 stars"></label><label class="full fa " for="star_2" title="Awesome - 2 stars"></label><label class="full fa active" for="star_3" title="Awesome - 3 stars"></label><label class="full fa active" for="star_4" title="Awesome - 4 stars"></label><label class="full fa active" for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            else if(data.data[i].product_rating == 4){
                                rating = '<label class="full fa " for="star1" title="Awesome - 1 stars"></label><label class="full fa active" for="star_2" title="Awesome - 2 stars"></label><label class="full fa active" for="star_3" title="Awesome - 3 stars"></label><label class="full fa active" for="star_4" title="Awesome - 4 stars"></label><label class="full fa active" for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            else if(data.data[i].product_rating == 5){
                                rating = '<label class="full fa active" for="star1" title="Awesome - 1 stars"></label><label class="full fa active" for="star_2" title="Awesome - 2 stars"></label><label class="full fa active" for="star_3" title="Awesome - 3 stars"></label><label class="full fa active" for="star_4" title="Awesome - 4 stars"></label><label class="full fa active" for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            else{
                                rating = '<label class="full fa " for="star1" title="Awesome - 1 stars"></label><label class="full fa " for="star_2" title="Awesome - 2 stars"></label><label class="full fa " for="star_3" title="Awesome - 3 stars"></label><label class="full fa " for="star_4" title="Awesome - 4 stars"></label><label class="full fa " for="star_5" title="Awesome - 5 stars"></label>'
                            }
                            
                            clone.querySelector(".display-rating").innerHTML = rating;
                            clone.querySelector(".display-rating1").innerHTML = rating;

                            if (data.data[i].product_gallary != null && data.data[i].product_gallary !=
                                'null' && data.data[i].product_gallary != '') {
                                if (data.data[i].product_gallary.detail != null && data.data[i].product_gallary
                                    .detail != 'null' && data.data[i].product_gallary.detail != '') {
                                    clone.querySelector(".product-card-image").setAttribute('src', data.data[i]
                                        .product_gallary.detail[1].gallary_path);
                                }
                            }
                            if (data.data[i].detail != null && data.data[i].detail != 'null' && data.data[i]
                                .detail != '') {
                                clone.querySelector(".product-card-image").setAttribute('alt', data.data[i]
                                    .detail[0].title);
                            }
                            if (data.data[i].category != null && data.data[i].category != 'null' && data.data[i]
                                .category != '') {
                                if (data.data[i].category[0].category_detail != null && data.data[i].category[0]
                                    .category_detail != 'null' && data.data[i].category[0].category_detail != ''
                                ) {
                                    if (data.data[i].category[0].category_detail.detail != null && data.data[i]
                                        .category[0].category_detail.detail != 'null' && data.data[i].category[
                                            0].category_detail.detail != '') {
                                        clone.querySelector(".product-card-category").innerHTML = data.data[i]
                                            .category[0].category_detail.detail[0].name;
                                    }
                                }
                            }
                            if (data.data[i].detail != null && data.data[i].detail != 'null' && data.data[i]
                                .detail != '') {
                                clone.querySelector(".product-card-name").innerHTML = data.data[i].detail[0]
                                    .title;
                                clone.querySelector(".product-card-name").setAttribute('href', '/product/' +
                                    data
                                    .data[i].product_id + '/' + data
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
                                    clone.querySelector(".product-card-price").innerHTML =
                                    data.data[i]
                                        .product_discount_price_symbol + '<span>' +data.data[i].product_price_symbol + '</span>';
                                }
                            } else {
                                if (data.data[i].product_combination != null && data.data[i]
                                    .product_combination != 'null' && data.data[i].product_combination != '') {
                                    clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                        .product_combination[0].product_price_symbol;
                                }
                            }
                            if (data.data[i].product_type == 'simple') {
                                clone.querySelector(".product-card-link").setAttribute('onclick',
                                    "addToCart(this)");
                                clone.querySelector(".product-card-link").setAttribute('data-id', data.data[i]
                                    .product_id);
                                clone.querySelector(".product-card-link").setAttribute('data-type', data.data[i]
                                    .product_type);
                                clone.querySelector(".product-card-link").innerHTML = 'Add To Cart';
                            } else {
                                clone.querySelector(".product-card-link").setAttribute('href', '/product/' +
                                    data
                                    .data[i].product_id + '/' + data
                                    .data[i].product_slug);
                            }

                            $("." + appendTo).append(clone);
                            
                            if (appendTo == 'new-arrival' || appendTo == 'weekly-sale') {
                                $(".div-class").addClass('col-12 col-sm-6 col-lg-3');
                            }
                        }


                        if (appendTo != 'new-arrival' && appendTo != 'weekly-sale')
                            getSliderSettings(appendTo);
                    }
                },
                error: function(data) {},
            });
        }


        function fetchFeaturedWeeklyProduct(url, appendTo) {
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
                        console.log(data,"final data");
                        var htmlToRender ="<article><div class='badges'><span class='badge badge-success'>Featured</span></div><div class='detail'>";
                        
                            htmlToRender +='<h5 class="title"><a  href="/product/'+data
                                    .data[0].product_id +'/'+data
                                    .data[0].product_slug+'">'+data.data[0].detail[0]
                                    .title+'</a></h5>';


                            htmlToRender +='<p class="discription">'+data.data[0].detail[0]
                                    .desc+'</p>';
                            
                            
                            

                            if (data.data[0].product_type == 'simple') {
                                if (data.data[0].product_discount_price == '' || data.data[0]
                                    .product_discount_price == null || data.data[0].product_discount_price ==
                                    'null') {
                                    htmlToRender +='<div class="price">'+data.data[0]
                                        .product_price_symbol+'</div>';
                                } else {
                                    htmlToRender +='<div class="price">'+data.data[0]
                                        .product_discount_price_symbol + '<span>' +data.data[0].product_price_symbol + '</span></div>';
                                }
                            } else {
                                if (data.data[0].product_combination != null && data.data[0]
                                    .product_combination != 'null' && data.data[0].product_combination != '') {
                                        htmlToRender +='<div class="price">'+data.data[0]
                                        .product_combination[0].product_price_symbol+'</div>';
                                }
                            }

                            htmlToRender +='<div class="pro-sub-buttons"><div class="buttons"><button type="button" class="btn  btn-link " data-id='+data.data[0]
                                .product_id+' onclick="addWishlist(this)" data-type='+data.data[0]
                                .product_type+'><i class="fas fa-heart"></i>Add to Wishlist</button>';
                                
                            htmlToRender +='<button type="button" class="btn btn-link" data-id='+data.data[0]
                                .product_id+' data-type='+data.data[0]
                                .product_type+' onclick="addCompare(this)" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add to Compare"><i class="fas fa-align-right"></i>Add to Compare</button></div></div></div>';
                            htmlToRender +='<picture><div class="product-hover">';
                            if (data.data[0].product_type == 'simple') {
                                
                                htmlToRender +='<button type="button" onclick="addToCart(this)" class="btn btn-block btn-secondary cart swipe-to-top" >Add to Cart</button>';

                            } else {
                                
                                htmlToRender +='<a href="/product/'+data
                                    .data[0].product_id +'/'+data
                                    .data[0].product_slug+'" onclick="addToCart(this)" class="btn btn-block btn-secondary cart swipe-to-top" >View Detail</a>';
        
                            }
                            
                            htmlToRender +='</div>';

                             if (data.data[0].product_gallary != null && data.data[0].product_gallary !=
                                'null' && data.data[0].product_gallary != '') {
                                if (data.data[0].product_gallary.detail != null && data.data[0].product_gallary
                                    .detail != 'null' && data.data[0].product_gallary.detail != '') {
                                       htmlToRender +='<img class="img-fluid" src="'+data.data[0]
                                        .product_gallary.detail[1].gallary_path+'" alt="Men"s Cotton Classic Baseball Cap">';

                                }
                            }
                            htmlToRender +='</picture></article>';
                           

                        $('#weekly-sale-first-div').html(htmlToRender);
                    }
                },
                error: function(data) {},
            });
        }

        function blogNews() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/blog_news?getGallaryDetail=1&limit=10&sortBy=id&language_id=' + languageId +
                    '&getDetail=1&getBlogCategory=1&sortType=DESC',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".blog-news-data").html('');
                        const templ = document.getElementById("news-blog-template");
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        for (i = 0; i < data.data.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                            clone.querySelector(".news-blog-date").innerHTML = data.data[i].date;
                            clone.querySelector(".news-blog-date").setAttribute('data-id', data.data[i]
                                .product_id);
                            clone.querySelector(".blog-url").setAttribute('href', '/blog-detail/' + data.data[i]
                                .slug);
                            clone.querySelector(".read-more-url").setAttribute('href', '/blog-detail/' + data
                                .data[i].slug);

                            if (data.data[i].gallary != null && data.data[i].gallary != 'null' && data.data[i]
                                .gallary != '') {
                                if (data.data[i].gallary.detail != null && $.trim(data.data[i].gallary
                                        .detail) != '' && data.data[i].gallary.detail != 'null') {
                                    if (data.data[i].gallary.detail[2].gallary_path) {
                                        clone.querySelector(".news-blog-image").setAttribute('src', data.data[i]
                                            .gallary.detail[1].gallary_path);
                                    } else {
                                        clone.querySelector(".news-blog-image").setAttribute('src', data.data[i]
                                            .gallary.detail[0].gallary_path);
                                    }
                                }
                            }
                            if (data.data[i].detail != null && $.trim(data.data[i].detail) != '' && data.data[i]
                                .detail != 'null') {
                                clone.querySelector(".news-blog-image").setAttribute('alt', data.data[i].detail[
                                    0].name);
                            }
                            if (data.data[i].category != null && data.data[i].category != 'null' && $.trim(data
                                    .data[i].category) != '') {
                                if (data.data[i].category.blog_detail != null && data.data[i].category
                                    .blog_detail != 'null' && data.data[i].category.blog_detail != '') {
                                    clone.querySelector(".news-blog-category").innerHTML = data.data[i].category
                                        .blog_detail[0].name;
                                }
                            }
                            if (data.data[i].detail != null && data.data[i].detail != 'null' && $.trim(data
                                    .data[i].detail) != '') {
                                clone.querySelector(".news-blog-name").innerHTML = data.data[i].detail[0].name;
                                clone.querySelector(".news-blog-desc").innerHTML = data.data[i].detail[0]
                                    .description;
                            }
                            $(".blog-news-data").append(clone);
                        }
                        getSliderSettings("blog-news-data");
                    }
                },
                error: function(data) {},
            });
        }



        function sliderMedia() {
            var sliderType = "{{ getSetting()['slider_style'] ? getSetting()['slider_style'] : '' }}";
            if (sliderType == "style1") {
                sliderType = 1;
            }
            if (sliderType == "style2") {
                sliderType = 2;
            }
            if (sliderType == "style3") {
                sliderType = 3;
            }
            if (sliderType == "style4") {
                sliderType = 4;
            }
            if (sliderType == "style5") {
                sliderType = 5;
            }
            sliderType = 2;
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/slider?getLanguage=' + languageId +
                    '&getSliderType=1&getSliderNavigation=1&getSliderGallary=1&limit=5&sortBy=id&sortType=DESC&sliderType=' +
                    sliderType + '&language_id=' + languageId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".slider-navigation-show").html('');
                        const templ = document.getElementById("slider-navigation-template");
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        for (i = 0; i < data.data.length; i++) {


                            $("#slider-bullets-" + i).addClass("d-block");
                            $("#slider-bullets-" + i).removeClass('d-none')

                            const clone = templ.content.cloneNode(true);
                            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                            clone.querySelector(".slider-navigation-title").innerHTML = data.data[i]
                                .slider_title;
                            clone.querySelector(".slider-navigation-desc").innerHTML = data.data[i]
                                .slider_description;
                            clone.querySelector(".slider-navigation-url").setAttribute('href', data.data[i]
                                .slider_url);

                            clone.querySelector(".carousel-caption").classList.add(data.data[i]
                                .slider_position);
                            clone.querySelector(".carousel-caption").classList.add(data.data[i]
                                .slider_textcontent);
                            clone.querySelector(".carousel-caption").classList.add(data.data[i]
                                .slider_text);
                                
                            if (i == 0) {
                                clone.querySelector(".slider-navigation-active").classList.add("active");
                            }
                            if (data.data[i].gallary != null && $.trim(data.data[i].gallary) != '') {
                                clone.querySelector(".slider-navigation-image").setAttribute('src',
                                    '/gallary/' + data.data[i].gallary);
                            }
                            $(".slider-navigation-show").append(clone);
                        }
                    }
                },
                error: function(data) {},
            });


            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/constant_banner?getLanguage=' + languageId +
                    '&title=rightsliderbanner&language_id=' + languageId + '&getGallary=1',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        var side_banners = '';
                        side_banners += '<figure class="banner-image imagespace">';
                        side_banners +=
                            '<a class="banner-slider-link1" href=""><img class="img-fluid banner-slider-image1" src="" alt="Banner Image"></a>';
                        side_banners += '</figure>';
                        side_banners += '<figure class="banner-image ">';
                        side_banners +=
                            '<a class="banner-slider-link2" href=""><img class="img-fluid banner-slider-image2" src="" alt="Banner Image"></a>';
                        side_banners += '</figure>';
                        $('.side-banners').html(side_banners);

                        $('.banner-slider-link1').attr('href', "{{ url('') }}" + data.data[0]
                            .banner_url);
                        $('.banner-slider-image1').attr('src', "/gallary/" + data.data[0].gallary.gallary_name);



                        $('.banner-slider-link2').attr('href', "{{ url('') }}" + data.data[1]
                            .banner_url);
                        $('.banner-slider-image2').attr('src', "/gallary/" + data.data[1].gallary.gallary_name);


                    }
                },
                error: function(data) {},
            });
        }


        function categorySlider() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/category?getDetail=1&page=1&limit=10&getGallary=1&language_id=' + languageId +
                    '&sortBy=category_name&sortType=DESC',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(".category-slider-show").html('');
                        const templ = document.getElementById("category-template");
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        for (i = 0; i < data.data.length; i++) {
                            const clone = templ.content.cloneNode(true);
                            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                            clone.querySelector(".category-slider-url").setAttribute('href', '/shop?category=' +
                                data.data[i].id);
                            // clone.querySelector(".category-slider-image").setAttribute('src', '/gallary/' + data
                            //     .data[i].icon);
                            $(clone).find(".hexagon").css('background-image', `url(/gallary/${data.data[i].icon})`);
                            clone.querySelector(".category-slider-title").innerHTML = data.data[i].name;
                            $("#categories-template-container").append(clone);
                        }
                        // getSliderSettings("category-slider-show");
                    }
                },
                error: function(data) {},
            });
        }



        function bannerMedia() {
            var bannerType = "{{ getSetting()['banner_style'] ? getSetting()['banner_style'] : 'style1' }}";
            if (bannerType == "style1") {
                bannerType = 'banner1';
            }
            if (bannerType == "style2" || bannerType == "style3" || bannerType == "style4") {
                bannerType = "banner2";
            }
            if (bannerType == "style5" || bannerType == "style6") {
                bannerType = "banner5";
            }
            if (bannerType == "style7" || bannerType == "style8") {
                bannerType = "banner7";
            }
            if (bannerType == "style9") {
                bannerType = "banner9";
            }
            if (bannerType == "style10" || bannerType == "style11" || bannerType == "style12") {
                bannerType = "banner10";
            }

            if (bannerType == "style13" || bannerType == "style14" || bannerType == "style15") {
                bannerType = "banner13";
            }

            if (bannerType == "style16" || bannerType == "style17") {
                bannerType = "banner16";
            }

            if (bannerType == "style18" || bannerType == "style19") {
                bannerType = "banner18";
            }
            $('.banner_div').css('display', 'none');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/constant_banner?getLanguage=' + languageId + '&title=' +
                    bannerType +
                    '&language_id=' + languageId + '&getGallary=1',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (typeof data.data[0] !== 'undefined') {
                            $('.banner-link1').attr('href', data.data[0]
                                .banner_url);

                            $('.banner-image1').attr('src', "/gallary/" + data.data[0].gallary
                                .gallary_name);
                        }



                        if (typeof data.data[1] !== 'undefined') {
                            $('.banner-link2').attr('href', data.data[1]
                                .banner_url);

                            $('.banner-image2').attr('src', "/gallary/" + data.data[1].gallary
                                .gallary_name);
                        }




                        if (typeof data.data[2] !== 'undefined') {
                            $('.banner-link3').attr('href', data.data[2]
                                .banner_url);
                            $('.banner-image3').attr('src', "/gallary/" + data.data[2].gallary
                                .gallary_name);
                        }

                        if (typeof data.data[3] !== 'undefined') {
                            $('.banner-link4').attr('href', data.data[3]
                                .banner_url);
                            $('.banner-image4').attr('src', "/gallary/" + data.data[3].gallary
                                .gallary_name);
                        }

                        if (typeof data.data[4] !== 'undefined') {

                            $('.banner-link5').attr('href', data.data[4]
                                .banner_url);
                            $('.banner-image5').attr('src', "/gallary/" + data.data[4].gallary
                                .gallary_name);
                        }
                        if (typeof data.data[5] !== 'undefined') {
                            $('.banner-link6').attr('href', data.data[5]
                                .banner_url);
                            $('.banner-image6').attr('src', "/gallary/" + data.data[5].gallary
                                .gallary_name);

                        }
                        $('.banner_div').css('display', 'block');
                    }
                },
                error: function(data) {},
            });
        }
    </script>
@endsection
