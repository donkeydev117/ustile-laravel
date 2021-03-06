<?php

namespace App\Repository\Admin;

use App\Contract\Admin\ProductInterface;
use App\Http\Resources\Admin\Product as ProductResource;
use App\Models\Admin\AvailableQty;
use App\Models\Admin\Language;
use App\Models\Admin\Product;
use App\Models\Admin\ProductGallaryDetail;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductReview;
use App\Models\Admin\ProductShippingStatus;
use App\Services\Admin\AccountService;
use App\Services\Admin\DeleteValidatorService;
use App\Services\Admin\PointService;
use App\Services\Admin\ProductService;
use App\Traits\ApiResponser;
use Illuminate\Support\Collection;
use App\Models\Admin\ProductVariationAlt;
use App\Models\Web\ProjectProduct;
use App\Models\Web\ProjectProductTag;
use Illuminate\Support\Str;

class ProductRepository implements ProductInterface
{
    use ApiResponser;
    /**
     * @return Collection
     */
    public function all()
    {
        $product = Product::type();
        try {
            if (isset($_GET['limit']) && is_numeric($_GET['limit']) && $_GET['limit'] > 0) {
                $numOfResult = $_GET['limit'];
            } else {
                $numOfResult = 100;
            }
            $languageId = Language::defaultLanguage()->value('id');
            if (isset($_GET['language_id']) && $_GET['language_id'] != '') {
                $language = Language::languageId($_GET['language_id'])->firstOrFail();
                $languageId = $language->id;
            }

            if (isset($_GET['getAllData']) && $_GET['getAllData'] == '1') {
                $product = $product->getProductDetailByLanguageId($languageId);
                return $this->successResponse(ProductResource::collection($product->select('id')->get()), 'Data Get Successfully!');
            }
            $product = $product->with('product_attribute.attribute.attribute_detail')->with('gallary');
            // With Primary Variation

            $product = $product->getAttributeDetailByLanguage($languageId);
            $product = $product->getVariationDetailByLanguage($languageId);

            if (isset($_GET['getCategory']) && $_GET['getCategory'] == '1') {
                $product = $product->getCategoryDetailByLanguageId($languageId);
            }

            if (isset($_GET['productType']) && $_GET['productType'] != '') {
                $productType = explode(',', $_GET['productType']);
                $product = $product->whereIn('product_type', $productType);
            }

            if (isset($_GET['brandId']) && $_GET['brandId'] != '') {
                $brandId = explode(',', $_GET['brandId']);
                $product = $product->whereIn('brand_id', $brandId);
            }

            if (isset($_GET['stock']) && $_GET['stock'] == '1') {
                $product = $product->with('stock');
            }

            if (isset($_GET['isFeatured']) && $_GET['isFeatured'] == '1') {
                $product = $product->where('is_featured', $_GET['isFeatured']);
            }

            if (isset($_GET['productCategories']) && $_GET['productCategories'] != '') {

                $productCategory = explode(',', $_GET['productCategories']);
                // dd($productCategory);
                $product = $product->whereHas('category', function ($query) use ($productCategory) {
                    $query->whereIn('product_category.category_id', $productCategory);
                });
            }

            if (isset($_GET['sku']) && $_GET['sku'] != '') {
                $sku = $_GET['sku'];
                $product = $product->where(function ($query) use ($sku) {
                    $query->whereHas('product_combination', function ($query1) use ($sku) {
                        $query1->where('product_combination.sku', $sku);
                    })->orWhere('sku', $sku);
                });
            }

            if (isset($_GET['searchParameter']) && $_GET['searchParameter'] != '') {
                $productTitle = $_GET['searchParameter'];
                $product = $product->whereHas('detail', function ($query) use ($productTitle) {
                    $query->where('product_detail.title', 'like', '%' . $productTitle . '%')->orWhere('product_detail.title', 'like', '%' . $productTitle . '%');
                });
            }

            $sortBy = ['id', 'price', 'product_type', 'discount_price', 'product_status', 'product_view', 'seo_desc', 'created_at'];
            $sortType = ['ASC', 'DESC', 'asc', 'desc'];
            if (isset($_GET['sortBy']) && $_GET['sortBy'] != '' && isset($_GET['sortType']) && $_GET['sortType'] != '' && in_array($_GET['sortBy'], $sortBy) && in_array($_GET['sortType'], $sortType)) {
                $product = $product->orderBy($_GET['sortBy'], $_GET['sortType']);
            }

            $sortBy = ['title'];
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                $product = $product->getProductDetailByLanguageId($languageId);
                $productSortType = $productSortBy = '';
                if (isset($_GET['sortBy']) && $_GET['sortBy'] != '' && isset($_GET['sortType']) && $_GET['sortType'] != '' && in_array($_GET['sortBy'], $sortBy) && in_array($_GET['sortType'], $sortType)) {
                    $productSortType = $_GET['sortType'];
                    $productSortBy = $_GET['sortBy'];
                    $product = $product->sortByProductDetail($productSortBy, $productSortType, $languageId);
                }
            }

            $sortBy = ['category_name'];
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                $product = $product->getProductDetailByLanguageId($languageId);
                $productSortType = $productSortBy = '';
                if (isset($_GET['sortBy']) && $_GET['sortBy'] != '' && isset($_GET['sortType']) && $_GET['sortType'] != '' && in_array($_GET['sortBy'], $sortBy) && in_array($_GET['sortType'], $sortType)) {
                    $productSortType = $_GET['sortType'];
                    $productSortBy = $_GET['sortBy'];
                    $product = $product->sortByCategory($productSortBy, $productSortType, $languageId);
                }
            }

            if (isset($_GET['topSelling']) && $_GET['topSelling'] == '1') {
                $product = $product->sortByTopSellingProduct('qty', 'desc');
            }

            if (isset($_GET['price_from']) && $_GET['price_from'] != '' && isset($_GET['price_to']) && $_GET['price_to'] != '') {
                $product = $product->getProductByPrice($_GET['price_from'], $_GET['price_to']);
            }

            if (\Request::route()->getName() == 'products.index') {
                $product = $product->active()->addSelect([
                    'avg_rating' => ProductReview::whereColumn('product_review.product_id', 'products.id')->where('status', 'active')->selectRaw('avg(rating)'),
                ]);
            }
            if (isset($_GET['variations']) && $_GET['variations'] != '') {
                $variations = explode(',', $_GET['variations']);
                // dd($variations);
                $product = $product->whereHas('product_attribute.variation', function ($query) use ($variations) {
                    $query->whereIn('product_variation.variation_id', $variations);
                });
            }
            // return $product->toSql();

            return $this->successResponse(ProductResource::collection($product->paginate($numOfResult)), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function show($singleProduct)
    {
        $product = Product::type()->with('product_attribute.attribute.attribute_detail');
        try {
            $languageId = Language::defaultLanguage()->value('id');
            if (isset($_GET['language_id']) && $_GET['language_id'] != '') {
                $language = Language::languageId($_GET['language_id'])->firstOrFail();
                $languageId = $language->id;
            }
            $product = $product->getAttributeDetailByLanguage($languageId);
            $product = $product->getVariationDetailByLanguage($languageId);

            if (isset($_GET['getCategory']) && $_GET['getCategory'] == '1') {
                $product = $product->getCategoryDetailByLanguageId($languageId);
            }

            if (isset($_GET['productType']) && $_GET['productType'] != '') {
                $productType = explode(',', $_GET['productType']);
                $product = $product->whereIn('product_type', $productType);
            }

            if (isset($_GET['brandId']) && $_GET['brandId'] != '') {
                $brandId = explode(',', $_GET['brandId']);
                $product = $product->whereIn('brand_id', $brandId);
            }

            if (isset($_GET['stock']) && $_GET['stock'] == '1') {
                $product = $product->with('stock');
            }
            if (isset($_GET['getDetail']) && $_GET['getDetail'] == '1') {
                if (\Request::route()->getName() == 'products.show') {
                    $product = $product->getProductDetailByLanguageId($languageId);
                } else {
                    if (isset($_GET['language_id']) && $_GET['language_id'] != '') {
                        $product = $product->getProductDetailByLanguageId($languageId);
                    } else {
                        $product = $product->with('detail');
                    }
                }
            }
            if (isset($_GET['getDetailWithLanguage']) && $_GET['getDetailWithLanguage'] == '1') {
                $product = $product->getProductDetailByLanguageId($languageId);
            }
            $product->productId($singleProduct->id);
            // $product->first();

            if (isset($_GET['hash']) && $_GET['hash'] != '') {
                $point = new PointService;
                $point->productSharePoints($_GET['hash'], $singleProduct->id);
            }

            if (\Request::route()->getName() == 'products.show') {
                $product = $product->active()->addSelect([
                    'avg_rating' => ProductReview::whereColumn('product_review.product_id', 'products.id')->where('status', 'active')->selectRaw('avg(rating)'),
                ]);
            }

            // die(print_r($product->first()));

            return $this->successResponse(new ProductResource($product->first()), 'Data Get Successfully!');
        } catch (Exception $e) {
            return $this->errorResponse();
        }
    }

    public function showAlt($singleProduct){

        $product = Product::where("id", $singleProduct->id)
                        ->with("review")
                        ->with("brand")
                        ->with('gallary')
                        ->with('category.category.detail')
                        ->with('detail')
                        ->with('productDetail')
                        ->with('productGallaryDetail')
                        ->with('materialDetail')
                        ->with('shippingStatus')
                        ->get();


        return $this->successResponse(new ProductResource($product->first()), 'Data Get Successfully!');

    }

    public function store(array $parms)
    {

        if ($parms['product_type'] == 'digital') {
            if (!isset($parms['digital_file']) || $parms['digital_file'] == '') {
                return $this->errorResponse('digital_file Required.');
            }

            try {
                $destinationPath = public_path('/digital');
                $productService = new ProductService;
                $result = $productService->saveDigitalFile($parms['digital_file'], $destinationPath);
                if ($result == 0) {
                    return $this->errorResponse('Only Zip File Required.');
                }
                $parms['digital_file'] = $result['name'];
                \DB::beginTransaction();
                $parms['user_id'] = \Auth::id();
                $parms['product_slug'] = str_replace(" ", "-", $parms['title'][0]);
                $product_slug = Product::slug($parms['product_slug'])->first();
                // if ($product_slug) {
                //     $parms['product_slug'] = $parms['product_slug'] . '-' . rand(1, 20);
                // }
                $checkSlug = Product::where('product_slug', $parms['product_slug'])->first();
                if ($checkSlug) {
                    $checkSlug = Product::where('product_slug', 'like', $parms['product_slug'] . '%')->latest()->value('product_slug');
                    $slugInt = substr($checkSlug, strrpos($checkSlug, '-') + 1);
                    if (is_numeric($slugInt)) {
                        $slugInt++;
                        $parms['product_slug'] = $parms['product_slug'] . '-' . $slugInt;
                    } else {
                        $parms['product_slug'] = $parms['product_slug'] . '-1';
                    }
                }
                $sql = new Product;
                $parms['created_by'] = \Auth::id();
                $sql = $sql->create($parms);
            } catch (Exception $e) {
                \DB::rollback();
                return $this->errorResponse();
            }

            $productService = new ProductService;
            $product_result = $productService->simpleProductDetailData($parms, $sql->id, 'store');
        } else {
            \DB::beginTransaction();
            try {
                $parms['digital_file'] = '';
                $parms['user_id'] = \Auth::id();
                $parms['product_slug'] = str_replace(" ", "-", $parms['title'][0]);
                
                $sql = new Product;
                $parms['product_slug'] = $parms['sku'];
                $parms['created_by'] = \Auth::id();

                $sql = $sql->create($parms);
                if ($parms['product_type'] == 'simple') {
                    $accounts = new AccountService;
                    $accounts->createAccount('SUPPLIES', $parms['title'][0], $sql->id);
                }
            } catch (Exception $e) {
                \DB::rollback();
                return $this->errorResponse();
            }
            $productService = new ProductService;
            $product_result = $productService->simpleProductDetailData($parms, $sql->id, 'store');

            if ($parms['product_type'] == 'variable' && $sql) {
                $variable_result = $productService->variableProductDetailData($parms, $sql->id, 'store');
                if ($variable_result) {
                    \DB::commit();
                    return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($sql->id)->firstOrFail()), 'Product Save Successfully!');
                } else {
                    \DB::rollback();
                    return $this->errorResponse();
                }
            }
        }

        if ($product_result) {
            $productService->saveProductGallaryImage($sql->id, $parms['gallary_detail_id']);
            \DB::commit();
            return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($sql->id)->firstOrFail()), 'Product Save Successfully!');
        } else {
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    // Created by me
    public function storeProduct(array $params){

        \DB::beginTransaction();
        try{
            $product = new Product;
            $product->product_type = 'variable';
            $product->product_slug = Str::slug($params['sku']);
            $product->sku = $params['sku'];
            $product->gallary_id = $params['gallary_id'];
            // Need to add product gallary details
            $product->price = $params['price'];
            $product->product_status = $params['product_status'];
            $product->brand_id = $params['brand_id'];
            $product->is_featured = $params['is_featured'];
            $product->seo_meta_tag = $params['seo_meta_tag'];
            $product->seo_desc = $params['seo_desc'];
            $product->made_in_usa = $params['made_in_usa'];
            $product->material = $params['material'];
            $product->application = implode(",", $params['applications']);
            $product->user_id = \Auth::id();
            $product->created_by = \Auth::id();
    
            $product->save();
            ProductShippingStatus::where('product_id', $product->id)->delete();
            $shippingStatus = $params['shipping_status'];

            foreach($shippingStatus as $s){
                ProductShippingStatus::create([
                    'product_id' => $product->id,
                    'shipping_status_id' => $s,
                ]);
            }

            $productService = new ProductService;
            $product_result = $productService->simpleProductDetailData($params, $product->id, 'store');
            $gallary_detail_id = $params['gallary_detail_id'];
            $productService->saveProductGallaryImage($product->id, [$gallary_detail_id]);
    
            $variants = $params['variants'];
    
            foreach($variants as $v){
                $variant                = new ProductVariationAlt;
                $variant->product_id    = $product->id;
                $variant->name          = $v['name'];
                $variant->color         = $v['color']['id'];
                $variant->shade         = $v['shade']['id'];
                $variant->finish        = $v['finish']['id'];
                $variant->look          = $v['look']['id'];
                $variant->shape         = $v['shape']['id'];
                $variant->box_size      = $v['box_size'];
                $variant->width         = $v['width'];
                $variant->length        = $v['length'];
                $variant->price         = $v['price'];
                $variant->sample_price  = $v['sample_price'];
                $variant->sku           = $v['sku'];
                $variant->media_id      = $v['media'] ? $v['media']['gallary_id'] : 0;
                $variant->is_primary    = $v['is_primary'];
                $variant->save();
            }
            \DB::commit();
            return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($product->id)->firstOrFail()), 'Product Save Successfully!');
        } catch(Exception $e){
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    public function update(array $parms, $product)
    {
        // return $parms['gallary_detail_id'];
        
        if ($parms['product_type'] == 'digital') {
            if (isset($parms['digital_file']) && $parms['digital_file'] != '') {
                $destinationPath = public_path('/digital');
                $productService = new ProductService;
                $result = $productService->saveDigitalFile($parms['digital_file'], $destinationPath);
                if ($result == 0) {
                    return $this->errorResponse('Only Zip File Required.');
                }
                $parms['digital_file'] = $result['name'];
            } else {
                $parms['digital_file'] = $product->digital_file;
            }

            try {
                \DB::beginTransaction();
                $parms['user_id'] = \Auth::id();
                $parms['product_slug'] = str_replace(" ", "-", $parms['title'][0]);
                $product_slug = Product::slug($parms['product_slug'])->NotProductId($product->id)->first();
                // if ($product_slug) {
                //     $parms['product_slug'] = $parms['product_slug'] . '-' . rand(1, 20);
                // }
                $checkSlug = Product::where('product_slug', $parms['product_slug'])->NotProductId($product->id)->first();
                if ($checkSlug) {
                    $checkSlug = Product::where('product_slug', 'like', $parms['product_slug'] . '%')->NotProductId($product->id)->latest()->value('product_slug');
                    $slugInt = substr($checkSlug, strrpos($checkSlug, '-') + 1);
                    if (is_numeric($slugInt)) {
                        $slugInt++;
                        $parms['product_slug'] = $parms['product_slug'] . '-' . $slugInt;
                    } else {
                        $parms['product_slug'] = $parms['product_slug'] . '-1';
                    }
                }

                $parms['updated_by'] = \Auth::id();
                $product->update($parms);
            } catch (Exception $e) {
                \DB::rollback();
                return $this->errorResponse();
            }

            $productService = new ProductService;
            $result = $productService->simpleProductDetailData($parms, $product->id, 'update');
        } else {
            \DB::beginTransaction();
            try {
                $parms['digital_file'] = '';
                $parms['user_id'] = \Auth::id();
                // $parms['product_slug'] = str_replace(" ", "-", $parms['title'][0]);
                // $product_slug = Product::slug($parms['product_slug'])->NotProductId($product->id)->first();
                // // if ($product_slug) {
                // //     $parms['product_slug'] = $parms['product_slug'] . '-' . rand(1, 20);
                // // }

                // $checkSlug = Product::where('product_slug', $parms['product_slug'])->NotProductId($product->id)->first();
                // if ($checkSlug) {
                //     $checkSlug = Product::where('product_slug', 'like', $parms['product_slug'] . '%')->NotProductId($product->id)->latest()->value('product_slug');
                //     $slugInt = substr($checkSlug, strrpos($checkSlug, '-') + 1);
                //     if (is_numeric($slugInt)) {
                //         $slugInt++;
                //         $parms['product_slug'] = $parms['product_slug'] . '-' . $slugInt;
                //     } else {
                //         $parms['product_slug'] = $parms['product_slug'] . '-1';
                //     }
                // }
                $parms['product_slug'] = $parms['sku'];
                $parms['updated_by'] = \Auth::id();
                $product->update($parms);
            } catch (Exception $e) {
                \DB::rollback();
                return $this->errorResponse();
            }

            $productService = new ProductService;
            $result = $productService->simpleProductDetailData($parms, $product->id, 'update');

            if ($parms['product_type'] == 'variable' && $product) {
                $variable_result = $productService->variableProductDetailData($parms, $product->id, 'update');
                if ($variable_result) {
                    $productService->saveProductGallaryImage($product->id, $parms['gallary_detail_id']);
                    \DB::commit();
                    return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($product->id)->firstOrFail()), 'Product Update Successfully!');
                } else {
                    \DB::rollback();
                    return $this->errorResponse();
                }
            }
        }

        if ($result) {
            $productService->saveProductGallaryImage($product->id, $parms['gallary_detail_id']);
            \DB::commit();
            return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($product->id)->firstOrFail()), 'Product Update Successfully!');
        } else {
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    // Update function by me

    public function updateProduct($params, $product){
        \DB::beginTransaction();
        try{
            $product->product_type = 'variable';
            $product->product_slug = Str::slug($params['sku']);
            $product->sku = $params['sku'];
            $product->gallary_id = $params['gallary_id'];
            // Need to add product gallary details
            $product->price = $params['price'];
            $product->product_status = $params['product_status'];
            $product->brand_id = $params['brand_id'];
            $product->is_featured = $params['is_featured'];
            $product->seo_meta_tag = $params['seo_meta_tag'];
            $product->seo_desc = $params['seo_desc'];
            $product->made_in_usa = $params['made_in_usa'];
            $product->material = $params['material'];
            $product->application = implode(",", $params['applications']);
            $product->user_id = \Auth::id();
            $product->created_by = \Auth::id();
            $product->save();

            ProductShippingStatus::where('product_id', $product->id)->delete();
            $shippingStatus = $params['shipping_status'];

            foreach($shippingStatus as $s){
                ProductShippingStatus::create([
                    'product_id' => $product->id,
                    'shipping_status_id' => $s,
                ]);
            }
            $productService = new ProductService;
            $product_result = $productService->simpleProductDetailData($params, $product->id, 'update');
            $gallary_detail_id = $params['gallary_detail_id'];
            $productService->saveProductGallaryImage($product->id, [$gallary_detail_id]);
    
            $variants = $params['variants'];

            ProductVariationAlt::where("product_id", $product->id)->delete();
    
            foreach($variants as $v){
                $variant                = new ProductVariationAlt;
                $variant->product_id    = $product->id;
                $variant->name          = $v['name'];
                $variant->color         = $v['color']['id'];
                $variant->shade         = $v['shade']['id'];
                $variant->finish        = $v['finish']['id'];
                $variant->look          = $v['look']['id'];
                $variant->shape         = $v['shape']['id'];
                $variant->box_size      = $v['box_size'];
                $variant->width         = $v['width'];
                $variant->length        = $v['length'];
                $variant->price         = $v['price'];
                $variant->sample_price  = $v['sample_price']; 
                $variant->sku           = $v['sku'];
                $variant->media_id      = $v['media'] ? ( isset($v['media']['id']) ? $v['media']['id'] : $v['media']['gallary_id'])  : 0;
                $variant->is_primary    = $v['is_primary'];
                $variant->save();
            }
            \DB::commit();
            return $this->successResponse(new ProductResource(Product::with('category')->with("detail")->productId($product->id)->firstOrFail()), 'Product Save Successfully!');
        } catch(Exception $e){
            \DB::rollback();
            return $this->errorResponse();
        }
    }

    public function destroy($product)
    {
        $deleteValidatorService = new DeleteValidatorService;
        $isExistedInOtherTable = $deleteValidatorService->deleteValidate('product_id', $product);

        if ($isExistedInOtherTable === 1) {
            return $this->errorResponse('linked in another table can not be deleted', 422, null);
        }
        try {
            $sql = Product::findOrFail($product->id);
            $sql->delete();
            // Remove Product actions
            ProductCategory::where("product_id", $product->id)->delete();
            ProductGallaryDetail::where("product_id", $product->id)->delete();
            ProductVariationAlt::where("product_id", $product->id)->delete();
            $projectProducts = ProjectProduct::where("product_id", $product->id)->get();
            foreach($projectProducts as $pp){
                ProjectProduct::find($pp->id)->delete();
                ProjectProductTag::where("project_product_id", $pp->id)->delete();
            }

        } catch (Exception $e) {
            return $this->errorResponse();
        }

        if ($sql) {
            return $this->successResponse('', 'Product Delete Successfully!');
        } else {
            return $this->errorResponse();
        }
    }

    public function priceRange()
    {
        try {
            $sql = AvailableQty::selectRaw("min(price) AS min_price , max(price) AS max_price")->first();
            // $sql->delete();
        } catch (Exception $e) {
            return $this->errorResponse();
        }

        if ($sql) {
            return $this->successResponseArray($sql, 'Product Min and Max Get Successfully!');
        } else {
            return $this->errorResponse();
        }
    }

    public function sku($params)
    {

        try {
            $productSku = Product::where('product_type', 'simple')->orderBy('id', 'DESC')->limit(1)->value('sku');
        } catch (Exception $e) {
            return $this->errorResponse();
        }

        if ($productSku) {
            return $this->successResponseArray($productSku, 'Latest SKU get Successfully! 1');
        } else {
            return $this->successResponseArray('SKU-s-000', 'Latest SKU get Successfully!');
        }
    }


    public function filter($params){
        $query = Product::with('detail')->with('productGallaryDetail')->with('category');

        foreach($params as $key => $filterOptions){
            switch($key){
                case "application": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhere("application", 'LIKE', '%'.$option.'%');
                        }
                        break;
                    }
                case "material": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhere("material", $option);
                        }
                        break;
                    }
                case "brand":
                    {
                        foreach($filterOptions as $option){
                            $query->orWhere("brand_id", $option);
                        }
                        break;
                    }
                case "shade": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation("variations","shade", $option);
                        }
                    }
                    break;
                case "color": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation("variations", "color", $option);
                        }
                    }
                    break;
                case "finish": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation("variations","finish", $option);
                        }
                    }
                    break;
                case "shape": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation("variations","shape", $option);
                        }
                    }
                    break;
                case "looktrend": 
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation("variations","look", $option);
                        }
                    }
                    break;
                case 'shipping' :
                    {
                        foreach($filterOptions as $option){
                            $query->orWhereRelation('shippingStatus', 'shipping_status_id', $option);
                        }
                    }
                default: break;
            }
        }

        $data = $query->get();
        
        return $this->successResponseArray(ProductResource::collection($data), "Filter Success");
    }
}
