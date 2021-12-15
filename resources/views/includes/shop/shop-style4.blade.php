<style>
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
        /* width:   */
        width: 100%;
        padding-top: 100%;
        border-radius: 50%;
        cursor: pointer;
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
</style>

<!-- Shop Page One content -->
<div class="container-fuild">
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('lables.bread-crumb-home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('lables.bread-crumb-shop') }}</li>
            </ol>
        </div>
    </nav>
</div> 
<section class="pro-content">
    <div class="container-fluid pl-4 pr-4">
        <div class="page-heading-title">
            <h2> {{ trans('lables.shop-shop') }} </h2>
        </div>
    </div>
    <section class="shop-content shop-two pl-4 pr-2">
        <div class="container-fluid pl-4 pr-4">
            <div class="row">
                <div class="col-12 col-lg-4 d-lg-block d-xl-block right-menu">
                    {{-- Render Categories --}}
                    <div class="right-menu-categories">
                        <h5>{{__('Categories')}}</h5>
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
                    {{-- Applications --}}
                    <div class="right-menu-applications mt-4">
                        <h5>Application</h5>
                        <div class="row pr-4">
                            <div class="col-md-4 pr-2">
                                <div class="filter-application-item" style='background-image:url(/images/applications/kitchen.jpeg)'></div>
                                <span class='filter-item-label'>Kitchen</span>
                            </div>
                            <div class="col-md-4 pr-2">
                                <div class="filter-application-item" style='background-image:url(/images/applications/foyer.jpg)'></div>
                                <span class='filter-item-label'>Foyer</span>
                            </div>
                            <div class="col-md-4 pr-2">
                                <div class="filter-application-item" style='background-image:url(/images/applications/bathroom.jpeg)'></div>
                                <span class='filter-item-label'>Bathroom</span>
                            </div>
                        </div>
                    </div>
                    <hr />
                    {{-- Render Materials --}}
                    <div class="right-menu-materials mt-4">
                        <h5>{{ __('Material')}}</h5>
                        <div class="row">
                            @foreach($materials as $material)
                            <div class="col-md-3 pr-2">
                                <div class="filter-application-item" style='background-image:url({{ $material->media }})'></div>
                                <span class='filter-item-label'>{{ $material->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr />
                    {{-- Render Colors --}}
                    <div class="right-menu-colors mt-4">
                        <h5>{{__('Color')}}</h5>
                        <div class="row">
                            @foreach($colors as $color)
                            <div class="col-md-2 pr-2" >
                                <div class='fitler-color-item' style='background-color:{{$color->code}}'>

                                </div>
                            </div>
                            @endforeach
                        </div>
                      
                    </div>
                    {{-- Render Shades --}}
                    <div class="right-menu-shades mt-4">
                        <h5>{{__('Shade')}}</h5>
                        <div class="row">
                            @foreach($shades as $shade)
                            <div class="col-md-3 pr-2">
                                <div class="filter-application-item" style='background-image:url({{ $shade->media }})'></div>
                                <span class='filter-item-label'>{{ $shade->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Render Finishes --}}
                    <div class="right-menu-finishes mt-4">
                        <h5>{{__('Finish')}}</h5>
                        <div class="row">
                            @foreach($finishes as $finish)
                            <div class="col-md-3 pr-2">
                                <div class="filter-application-item" style='background-image:url({{ $finish->media }})'></div>
                                <span class='filter-item-label'>{{ $finish->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Render Shapes --}}
                    <div class="right-menu-shapes mt-4">
                        <h5>{{__('Shape')}}</h5>
                        <div class="row">
                            @foreach($shapes as $shape)
                            <div class="col-md-3 pr-2">
                                <div class="filter-application-item" style='background-image:url({{ $shape->media }})'></div>
                                <span class='filter-item-label'>{{ $shape->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Render Look & Trend --}}
                    <div class="right-menu-shapes mt-4">
                        <h5>{{__('Look & Trend')}}</h5>
                        <div class="row">
                            @foreach($looktrends as $looktrend)
                            <div class="col-md-3 pr-2">
                                <div class="filter-application-item" style='background-image:url({{ $looktrend->media }})'></div>
                                <span class='filter-item-label'>{{ $looktrend->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                  
                    {{-- End filter options done --}}

                    <div class="range-slider-main">
                        <a class=" main-manu" data-toggle="collapse" data-target="#price" role="button" aria-expanded="true" aria-controls="men-cloth">
                            {{ trans('lables.shop-price') }} 
                        </a>

                        <div class="sub-manu collapse show multi-collapse" id="price">
                            <ul class="unorder-list">
                                @foreach ($data['price_range'] as $price_range)
                                    <li class="list-item">
                                        @if (isset($_GET['price']) && $_GET['price'] == $price_range)
                                            <a class="list-link price-range-list price-range-list-{{ $price_range }} price-active" style="cursor: pointer;"
                                                data-price-range={{ $price_range }}>{{ $price_range }}
                                            </a>
                                        @else
                                            <a class="list-link price-range-list price-range-list-{{ $price_range }}" style="cursor: pointer;"
                                                data-price-range={{ $price_range }}>{{ $price_range }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="range-slider-main">
                        <button class="btn btn-primary filter-from-sidebar">{{ trans('lables.shop-apply') }}</button>
                        <a href="{{ url('/shop') }}" class="btn btn-primary">{{ trans('lables.shop-reset') }} </a>
                    </div>
                    <div class="range-slider-main">
                        <a class=" main-manu" data-toggle="collapse" href="#brands" role="button" aria-expanded="true" aria-controls="men-cloth">
                            {{ trans('lables.shop-brands') }} 
                        </a>
                        <div class="sub-manu collapse show multi-collapse" id="brands">
                            <ul class="unorder-list">
                                @foreach ($data['brand'] as $brand )
                                <li class="list-item">
                                    <a class="brands-btn list-item" href="{{ url('/shop?brand='.$brand->id) }}" role="button">
                                        <i class="fas fa-angle-right"></i>{{ $brand->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- <div class="img-main">
                        <a href="#"><img class="img-fluid" src="{{ asset("assets/front/images/shop/side-image.jpg") }}"></a>
                    </div> --}}
                </div>
                <div class="col-12 col-lg-8">
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
                                @include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")
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