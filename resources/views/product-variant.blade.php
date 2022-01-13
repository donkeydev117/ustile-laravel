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
    .calculator-container{
        display: none;
        color: #333;
        background-color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    b{
        font-family:  "Montserrat-Bold"
    }
    .tile-info{
        display: flex;
        justify-content: space-between;
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
                        <div class="variation-attribute">
                            {{ $variant['color']['color']}}/ {{$variant['finish']['name']}} / {{$variant['shade']['name']}} / {{ $variant['look']['name']}} / {{ $variant['shape']['name'] }} 
                        </div>
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
                            <a href="javascript:void(0)" class="d-block" id="show_calculator">Use Calculator?</a>
                            <div class="calculator-container">
                                <div class="tile-info mb-2">
                                    <span><b>Tile Size : </b>{{ intval($variant['width'])}}" x {{intval($variant['length'])}}"</span>
                                    <span><b>Pieces per Box: </b> {{ $variant['box_size']}}</span>
                                    <span><b>Sq.Ft. per Box: </b> {{ intval($variant['width']) * intval($variant['length']) * intval($variant['box_size']) / 144}} </span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Width of Room(ft)</label>
                                            <input type="number" step="0.1" class="form-control" id="calculator_room_width" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Length of Room(ft)</label>
                                            <input type="number" step="0.1" class="form-control" id="calculator_room_length" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Total Amount(boxes) : <span id="calculator_result"></span> 
                                            </label>
                                            <br>
                                            <span style="font-size:12px">*It includes 10% waste.</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <button 
                                type="button" 
                                class="btn btn-secondary btn-lg swipe-to-top add-to-cart mb-2" 
                                onclick="addToCart(this)"
                                data-type="variable"
                                data-id="{{$product->id}}"
                            >
                                Add to Cart
                            </button>
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
                        {{intval($ov['width'])}}" x {{ intval($ov['length'])}}" x {{ intval($ov['box_size'])}}ps
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
    @include('includes.productdetail.related-product-section')
</section>

@include('includes.productdetail.product-template')
@include('includes.productdetail.variation-card')

@include(isset(getSetting()['card_style']) ?
'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")

<input type="hidden" id="product_id" value="{{ $product->product_id }}" />
<input type="hidden" id="product_combination_id" value="{{ $variant['id']}}" />
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

    // For calculator
    var tileWidth = parseInt("{{ $variant['width'] }}"); // tile width in inch
    var tileLength = parseInt("{{ $variant['length']}}");
    var tileBoxSize = parseInt("{{$variant['box_size']}}");
    var sqFtBox = (tileWidth * tileLength * tileBoxSize) / 144;
    var price = parseFloat("{{ $variant['price']}}");

    function getCalculatorResult() {
        var roomWidth = $("#calculator_room_width").val();
        var roomLength = $("#calculator_room_length").val();

        if(roomWidth == "" || roomLength == "") return;

        var sqFtRoom = roomLength * roomLength;

        var estimated = Math.ceil(sqFtRoom / sqFtBox);
        var estimatedPrice = estimated * price;

        $("#calculator_result").text(`${estimated} boxes ($${estimatedPrice.toFixed(2)})`);
        $("#quantity-input").val(estimated);

    }

    $(document).ready(function(){
        
        $("#show_calculator").on("click", function(){
            $(".calculator-container").slideToggle(400);
        })

        $("#calculator_room_width").on("input", function(){
            getCalculatorResult();
        });
        $("#calculator_room_length").on("input", function(){
            getCalculatorResult();
        });

    });


</script>
@endsection