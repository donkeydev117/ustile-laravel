<style>
    .pro-content{
        padding-top: 25px !important;
        padding-left: 2rem;
        padding-right: 2rem;
    }
    .filter-item-label{
        position: absolute;
        bottom: 0;
        left: 15px;
        right: 0.5rem;
        text-align: center;
        background: #1a1a1a66;
        color: #fff;
    }
    .fitler-color-item {
        padding-top: 100% !important;
        border-radius: 50% !important;
    }
    .filter-application-item{
        width: 100%;
        padding-top: 80%;
        background-size: cover;
        background-position: center;
        cursor: pointer;
    }
    .right-menu{
        padding-right: 40px !important;
    }
    .nicescroll{
        height: 100vh;
        overflow: auto;
    }
    .right-menu-switch-container{
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        bottom: 10px;
        width: 100%;
        z-index: 10;
    }
    .switch-toggle{
        width: 300px;
    }
    .filter-selected .filter-application-item {
        border: 2px solid blue;
    }
    .filter-shipping-item{
        width: 100%;
        padding-top: 5px !important;
        border: 2px solid #333;
        border-radius: 5px;
        padding-bottom: 5px;
        text-align: center;
        font-size: 12px;
    }

    .product-card-image{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
    }
    .product article .thumb {
        width: 100%;
        padding-top: 100%;
        height: auto;
    }
    .product article {
        background-color: transparent;
    }
    .product article .content{
        padding: 0;
    }
    .action-buttons a {
        font-size: 32px;
        color: #888;
    }
    .action-buttons a:hover{
        color: #333;
    }
    .action-buttons a span { 
        font-size: 12px;
        display: block;
    }
    .red-content{
        background-color: #ef5f4b;
        padding: 10px;
        color: #fff;
        border-radius: 5px;
    }
    .add-to-cart-link {
        letter-spacing: 0px;
    }
    .border-right-white{
        border-right-color: #fff;
        border-right-width: 2px;
        border-right-style: solid;
    }
    .page-heading-title{
        margin-top: 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #e1d9d9
    }
    #sort-selector{
        width: 100px;
        border-color: red;
        border-width: 2px;
        appearance: auto;
        border-radius: 5px;
    }
    .pro-content .product{
        padding-top: 0px; 
        margin-bottom: 30px;
    }
    .filter-section-label {
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #999;
        font-family: 'Montserrat-Regular';
        text-transform: uppercase;
        font-size: 16px;
    }
    .collapse-card-header button {
        width : 100%;
        display: flex;
        justify-content: space-between;
    }
</style>

@include('product-quick-view')
<!-- Shop Page One content -->
<section class="pro-content">
    <div class="shop-content pl-4 pr-4 pb-4">
        <div class="page-heading-title d-flex justify-content-between">
            <h2> {{ trans('lables.shop-shop') }} </h2>
            <select class="form-control" id="sort-selector">
                <option value="">Sort</option>
                <option value="A-Z" data-sort-by="title" data-sort-type="asc">A-Z</option>
                <option value="Z-A" data-sort-by="title" data-sort-type="desc">Z-A</option>
            </select>
        </div>
    </div>
    <section class="shop-content shop-two">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-3 right-menu nicescroll">
                    <div class="right-menu-content d-none quick-view-right-menu"></div>
                    <div class="right-menu-content d-none compare-view-right-menu"></div>
                    {{-- Render Categories --}}
                    <div class="right-menu-content filter-view-right-menu" id="right-menu-accordian">
                        
                        <h5 class="filter-section-label">Collections</h5>

                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingCategory">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
                                        <span><i class="fas fa-layer-group mr-2"></i>Category</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-categories collapse pl-2 pr-2" id="collapseCategory" aria-labelledby="headingCategory" data-parent="#right-menu-accordian">
                                @foreach ($data['category'] as $category)
                                    @if ($category->parent == null)
                                        <a class=" main-manu" data-toggle="collapse" href="#{{ $category->category_slug }}" role="button"
                                            aria-expanded="false" aria-controls="{{ $category->category_slug }}">
                                            <img class="img-fuild" src="{{ asset('gallary/'.$category->icon->name) }}">
                                            {{ $category->detail[0]->category_name }}
                                        </a>
                                    @endif
                                    <div class="sub-manu collapse multi-collapse" id="{{ $category->category_slug }}">
                                        <ul class="unorder-list">
                                            @foreach ($data['category'] as $childCategory)
                                                @if ($childCategory->parent != null)
                                                    @if ($childCategory->parent->id === $category->id)
                                                        <li class="list-item">
                                                            <a class="list-link" href="{{ url('/shop?category='.$childCategory->id) }}">
                                                                <i class="fas fa-angle-right"></i>{{ $childCategory->detail[0]->category_name }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                     
                        {{-- Render Materials --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingMaterial">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseMaterial" aria-expanded="true" aria-controls="collapseMaterial">
                                        <span>
                                            <i class="fas fa-layer-group mr-2"></i>Material
                                        </span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-materials collapse  pl-2 pr-2" id="collapseMaterial" aria-labelledby="headingMaterial" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($materials as $material)
                                    <div class="col-md-3 pr-2 filter-item filter-material" data-id="{{ $material->id }}" data-filter="material">
                                        <div class="filter-application-item" style='background-image:url({{ $material->media }})'></div>
                                        <span class='filter-item-label'>{{ $material->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <h5 class="filter-section-label mt-4">Look</h5>
                        {{-- Render Colors --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingColors">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseColors" aria-expanded="true" aria-controls="collapseColors">
                                        <span><i class="fas fa-layer-group mr-2"></i>Colors</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-colors collapse  pl-2 pr-2" id="collapseColors" aria-labelledby="headingColors" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($colors as $color)
                                    <div class="col-md-2 pr-2 filter-item filter-color" data-id="{{ $color->id}}" data-filter="color"  >
                                        <div class='fitler-color-item filter-application-item' style='background-color:{{$color->code}}'>
        
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Render Shades --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingShades">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseShades" aria-expanded="true" aria-controls="collapseShades">
                                        <span><i class="fas fa-layer-group mr-2"></i>Shade</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-shades collapse  pl-2 pr-2" id="collapseShades" aria-labelledby="headingShades" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($shades as $shade)
                                    <div class="col-md-3 pr-2 filter-item filter-shade" data-id="{{ $shade->id }}" data-filter="shade">
                                        <div class="filter-application-item" style='background-image:url({{ $shade->media }})'></div>
                                        <span class='filter-item-label'>{{ $shade->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Render Finishes --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingFinish">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseFinish" aria-expanded="true" aria-controls="collapseFinish">
                                        <span><i class="fas fa-layer-group mr-2"></i>Finish</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-finishes collapse  pl-2 pr-2" id="collapseFinish" aria-labelledby="headingFinish" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($finishes as $finish)
                                    <div class="col-md-3 pr-2 filter-item filter-finish" data-id="{{ $finish->id}}" data-filter="finish">
                                        <div class="filter-application-item" style='background-image:url({{ $finish->media }})'></div>
                                        <span class='filter-item-label'>{{ $finish->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Render Shapes --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingShape">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseShape" aria-expanded="true" aria-controls="collapseShape">
                                        <span><i class="fas fa-layer-group mr-2"></i>Shape</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-shapes collapse  pl-2 pr-2" id="collapseShape" aria-labelledby="headingShape" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($shapes as $shape)
                                    <div class="col-md-3 pr-2 filter-item filter-shade" data-id="{{ $shape->id }}" data-filter="shape">
                                        <div class="filter-application-item" style='background-image:url({{ $shape->media }})'></div>
                                        <span class='filter-item-label'>{{ $shape->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
        
                        </div>
                        {{-- Render Look & Trend --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingLook">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseLook" aria-expanded="true" aria-controls="collapseLook">
                                        <span><i class="fas fa-layer-group mr-2"></i>Look</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-looktrend collapse  pl-2 pr-2" id="collapseLook" aria-labelledby="headingLook" data-parent="#right-menu-accordian">
                                <h5>{{__('Look & Trend')}}</h5>
                                <div class="row">
                                    @foreach($looktrends as $looktrend)
                                    <div class="col-md-3 pr-2 filter-item filter-looktrend" data-id="{{ $looktrend->id }}" data-filter="looktrend">
                                        <div class="filter-application-item" style='background-image:url({{ $looktrend->media }})'></div>
                                        <span class='filter-item-label'>{{ $looktrend->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h5 class="filter-section-label mt-4">Technical</h5>
                        {{-- Render For Brand --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingBrand">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseBrand" aria-expanded="true" aria-controls="collapseBrand">
                                        <span><i class="fas fa-layer-group mr-2"></i>Brand</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-brand collapse  pl-2 pr-2" id="collapseBrand" aria-labelledby="headingBrand" data-parent="#right-menu-accordian">
                                <div class="row">
                                    @foreach($data['brand'] as $brand)
                                    <div class="col-md-3 pr-2 filter-item filter-brand" data-id="{{ $brand->id }}" data-filter="brand">
                                        <div class="filter-application-item" style='background-image:url({{ $brand->gallary->detail[0]->path }})'></div>
                                        <span class='filter-item-label'>{{ $brand->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- Applications --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingApplication">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseApplication" aria-expanded="true" aria-controls="collapseApplication">
                                        <span><i class="fas fa-layer-group mr-2"></i>Application</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-applications collapse  pl-2 pr-2" id="collapseApplication" aria-labelledby="headingApplication" data-parent="#right-menu-accordian">
                                <div class="row pr-4">
                                    <div class="col-md-4 pr-2 filter-item filter-application" data-id='kitchen' data-filter="application" >
                                        <div class="filter-application-item" style='background-image:url(/images/applications/kitchen.jpeg)'></div>
                                        <span class='filter-item-label'>Kitchen</span>
                                    </div>
                                    <div class="col-md-4 pr-2 filter-item filter-application" data-id="foyer" data-filter="application">
                                        <div class="filter-application-item" style='background-image:url(/images/applications/foyer.jpg)'></div>
                                        <span class='filter-item-label'>Foyer</span>
                                    </div>
                                    <div class="col-md-4 pr-2 filter-item filter-application" data-id='bathroom' data-filter="application">
                                        <div class="filter-application-item" style='background-image:url(/images/applications/bathroom.jpeg)'></div>
                                        <span class='filter-item-label'>Bathroom</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="filter-section-label mt-4">Ready To Ship</h5>

                        {{-- Render for Shipping Options --}}
                        <div class="collapse-card">
                            <div class="collapse-card-header" id="headingShipping">
                                <h5 class="mb-0">
                                    <button class="btn btn-link pl-2 pr-2" data-toggle="collapse" data-target="#collapseShipping" aria-expanded="true" aria-controls="collapseShipping">
                                        <span><i class="fas fa-layer-group mr-2"></i>Shipping</span>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                </h5>
                            </div>
                            <div class="right-menu-shipping collapse  pl-2 pr-2" id="collapseShipping" aria-labelledby="headingShipping" data-parent="#right-menu-accordian">
                                <div class="row mt-2">
                                    @foreach($shippings as $s)
                                    <div class="col-12 pr-1 filter-item filter-shipping" data-id={{ $s->id }} data-filter="shipping">
                                        {{-- <div class="filter-application-item filter-shipping-item">
                                            {{ $s->name }}
                                        </div> --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="shipping-{{$s->id}}">
                                            <label class="form-check-label" >{{ $s->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        {{-- End filter options done --}}
                    </div>
                   
                    <div class="right-menu-switch-container d-none" id="right-menu-switch-container">
                        <div class="switch-toggle switch-candy">
                            <input id="switch-quick-view-compare" name="switch-quick-view" type="radio">
                            <label for="switch-quick-view-compare" id="switch-quick-view-compare-label">Compare</label>
                    
                            <input id="switch-quick-view-filter" name="switch-quick-view" type="radio">
                            <label for="switch-quick-view-filter" id="switch-quick-view-filter-label">Filter</label>
                    
                            <input id="switch-quick-view-view" name="switch-quick-view" type="radio">
                            <label for="switch-quick-view-view" id="switch-quick-view-view-label">View</label>
                            <a></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 nicescroll">
                    <div class="products-area">
                        <div class="top-bar d-none">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="block">
                                                <label>{{ trans('lables.shop-display') }} </label>
                                                <div class="buttons">
                                                    <a href="javascript:void(0);" id="grid_3column"><i class="fas fa-th-large"></i></a>
                                                    <a href="javascript:void(0);" id="list_3column"><i class="fas fa-list"></i></a>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-12 col-lg-6">
                                            <form class="form-inline justify-content-end">
                                                <div class="form-group">
                                                    <label>{{ trans('lables.shop-sort-by') }} </label>
                                                    <div class="select-control">
                                                        <select class="form-control sortBy" >
                                                            <option value="">choose</option>
                                                            <option disabled><b>Price</b></option>
                                                            <option value="low-high" data-sort-by="price" data-sort-type="asc">Low To High</option>
                                                            <option value="high-to" data-sort-by="price" data-sort-type="desc">High To Low</option>
                                                            <option disabled><b>Name</b></option>
                                                            <option value="A-Z" data-sort-by="title" data-sort-type="asc">A-Z</option>
                                                            <option value="Z-A" data-sort-by="title" data-sort-type="desc">Z-A</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <section id="swap" class="shop-content" >
                            <div class="products-area">
                                @include("includes.cart.product_card")
                                <div class="row shop_page_product_card"></div>
                            </div> 
                        </section>  
                    </div>
                    <div class="pagination justify-content-between "></div>
                </div>
            </div>
        </div>
    </section> 
</section>



