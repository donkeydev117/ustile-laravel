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

<input type="hidden" id="product_id" value="{{ $variant->product_id }}" />
<input type="hidden" id="variant_id" value="{{ $variant->id}}" />
@endsection


@section('script')