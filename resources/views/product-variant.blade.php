@extends('layouts.master')
@section('content')
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
    <div class="product-hero" style="background-image: url(/gallary/{{ $product->gallary->name }})">
    </div>
    <div class="product-summary-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 product-image-section">
                    {{-- Product Images --}}
                    <div class="product-variation-image zoom-box">
                        <img src="{{ $variant['media']['detail'][0]['path']}}" class="image-zoom"  />
                    </div>

                    {{-- Product Application --}}
                    <div class="product-applications-container">
                        <fieldset>
                            <legend>
                                <img src='{{ asset('images/applications/application.png')}}'/>
                                Applications
                            </legend>
                            <div class="product-applications row mt-2">
                                <div class="product-application col-sm-2 text-center">
                                    <img src='{{ asset('images/applications/kitchen.png')}}' />
                                    <p class="mt-1">Kitchen</p>
                                </div>
                                <div class="product-application col-sm-2 text-center ">
                                    <img src='{{ asset('images/applications/foyer.png')}}' />
                                    <p class="mt-1">Foyer</p>
                                </div>
                                <div class="product-application col-sm-2 text-center">
                                    <img src='{{ asset('images/applications/bathroom.png')}}' />
                                    <p class="mt-1">Bathroom</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="product-applications-container">
                        <fieldset>
                            <legend>
                                <img src='{{ asset('images/applications/application.png')}}'/>
                                Technical Data
                            </legend>
                            <div class="product-applications row mt-2">
                                <div class="product-application col-sm-2 text-center">
                                    <img src='{{ asset('images/applications/kitchen.png')}}' />
                                    <p class="mt-1">Stain Resistant</p>
                                </div>
                                <div class="product-application col-sm-2 text-center ">
                                    <img src='{{ asset('images/applications/foyer.png')}}' />
                                    <p class="mt-1">Frost Resistant</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h4 class="product-title">{{ $product->detail[0]->title}}</h4>
                    <p class="product-price">${{$variant['price']}}</p>
                    @if($variant['sample_price'] !=0 )<span>(Sample Price: $ {{$variant['sample_price']}})</span> @endif
                    <div class="variation-attribute">
                        <span>SKU:</span> {{ $variant['sku']}}
                    </div>
                    <div class="variation-attribute">
                       <span>Color:</span> {{ $variant['color']['color']}}
                    </div>
                    <div class="variation-attribute">
                        <span>Finish:</span> {{$variant['finish']['name']}}
                    </div>
                    <div class="variation-attribute">
                        <span>Shade:</span> {{$variant['shade']['name']}}
                    </div>
                    <div class="variation-attribute">
                        <span>Look:</span> {{$variant['look']['name']}}
                    </div>
                    <div class="variation-attribute">
                        <span>Shape:</span> {{$variant['shape']['name']}}
                    </div>
                    <div class="pro-counter">
                        <div class="input-group item-quantity">
                            <button type="button" class="quantity-minus btn quantity-left-minus" data-type="minus" data-field="">
                                <span class="fas fa-minus"></span>
                            </button>
                            <input type="text" id="quantity-input" name="quantity" class="form-control" value="1">
                            <button type="button" class="quantity-plus btn quantity-right-plus" data-type="plus" data-field="">
                                <span class="fas fa-plus"></span>
                            </button>
                        </div>
                        <a href="javascript:void(0)" class="d-block mt-2 mb-2" id="show_calculator">Use Calculator?</a>
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
                                        <label class="control-label">Waste Amount</label>
                                        <select class="form-control" id="calculator_waste_amount">
                                            <option value="0.1">10%</option>
                                            <option value="0.2">20%</option>
                                            <option value="0.3">30%</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Total Amount(boxes) : <span id="calculator_result"></span> 
                                        </label>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div>
                            <button 
                                type="button" 
                                class="btn btn-secondary btn-lg swipe-to-top add-to-cart mb-2" 
                                onclick="addToCart(this)"
                                data-type="variable"
                                data-id="{{$product->id}}">
                                Add to Cart
                            </button>

                            <button
                                type="button"
                                class="btn btn-danger btn-lg swipe-to-top request-sample mb-2"
                                onclick="addToCart(this,1)"
                                data-type="variable"
                                data-id="{{$product->id}}"
                            >
                                Request Sample
                            </button>
                        </div>
                        
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
    
    {{-- For Other variants --}}
    @if(count($other_variants) > 0)
    <section class="product-content pro-content related-product">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="pro-heading-title">
                      <h2>Other Variations</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis felis tempus feugiat maximus. </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
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
    </section>
    @endif

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
        var wasteAmount = $("#calculator_waste_amount").val();

        var estimated = Math.ceil(sqFtRoom / sqFtBox * (1 + wasteAmount) );
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

        $("#calculator_waste_amount").on("change", function(){
            getCalculatorResult();
        })

        $(".image-zoom").jqZoom({
            selectorWidth: 30,
            selectorHeight: 30,
            viewerWidth: 600,
            viewerHeight: 600
        });

       
    });

    // $(function(){
    //     $(".product-image-section").slick();
    // })
</script>
@endsection