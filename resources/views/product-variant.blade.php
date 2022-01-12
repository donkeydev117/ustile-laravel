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
        width : 100%;
        color: #fff;
        margin-top: 20px
    }
    .product-variation-image img{
        width: 100%;
    }
    .product-title{
        color: #333
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
    .variation-attribute{
        color: #333;
    }
</style>

<div class="container-fuild">
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('lables.bread-crumb-home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('lables.bread-product-page') }}</li>
            </ol>
        </div>
    </nav>
</div>

<section class="pro-content pt-0">
    <div class="product-hero">
        <div class="product-summary-container">
            <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-md-6">
                       <div class="product-variation-image">
                           <img src="{{ $variant['media']['detail'][0]['path']}}" />
                       </div>
                   </div>
                   <div class="col-sm-12 col-md-6">
                        <h4 class="product-title">{{ $product->detail[0]->title}}</h4>
                        <div class="variation-attribute">SKU: {{ $variant['sku']}}</div>
                        <div class="variation-attribute">Color: {{ $variant['color']['color']}} </div>
                        <div class="variation-attribute">Finish: {{$variant['finish']['name']}} </div>
                        <div class="variation-attribute">Shade: {{$variant['shade']['name']}}</div>
                        <div class="variation-attribute">Look: {{ $variant['look']['name']}}</div>
                        <div class="variation-attribute">Shape: {{ $variant['shape']['name'] }}</div>
                        <div class="variation-attribute">Price: $ {{ $variant['price']}}</div>
                        <div class="pro-counter">
                            <div class="input-group item-quantity">
                              <input type="text" id="quantity-input" name="quantity" class="form-control" value="1">
                              <span class="input-group-btn">
                                <button type="button" class="quantity-plus btn" data-type="plus" data-field="">
                                  <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="quantity-minus btn" data-type="minus" data-field="">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </span>
                            </div>
                            <button type="button" class="btn btn-secondary btn-lg swipe-to-top add-to-cart">Add to Cart</button>
                        </div>
                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_email"></a>
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="page-heading-title">
            <h2>Other Variations</h2>
        </div>
        <div class="row">
            @foreach($other_variants as $ov)
            <div class="col-sm-4 col-md-3">
                <a class="product-variation-card-container" href="/product/{{$product->id}}/{{$product->product_slug}}/variation/{{$ov['id']}}" target="_blank">
                    <div class="variation-image">
                        <img class="" src="{{ $ov['media']['detail'][0]['path']}}" />
                    </div>
            
                    <div class="variation-color-shape text-center">
                        {{ $ov['color']['color'] }}-{{ $ov['shape']['name']}} 
                    </div>
            
                    <div class="variatin-finish-look text-center">
                        {{$ov['finish']['name']}}-{{$ov['look']['name']}}
                    </div>
            
                    <div class="variation-size text-center">
                        {{intval($ov['width'])}}mm x {{ intval($ov['length'])}}mm x {{ intval($ov['box_size'])}}
                    </div>
            
                </a>
            </div>
            @endforeach
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

<input type="hidden" id="product_id" value="{{ $product->product_id }}" />
<input type="hidden" id="variant_id" value="{{ $variant['id']}}" />
@endsection

@section('script')
<script>
    languageId = localStorage.getItem("languageId");
    if (languageId == null || languageId == 'null') {
        localStorage.setItem("languageId", '1');
        $(".language-default-name").html('Endlish');
        localStorage.setItem("languageName", 'English');
        languageId = 1;
    }

    customerToken = $.trim(localStorage.getItem("customerToken"));

    function fetchProduct(){

    }

    $(document).ready(function(){
        fetchProduct();
    });


</script>
@endsection