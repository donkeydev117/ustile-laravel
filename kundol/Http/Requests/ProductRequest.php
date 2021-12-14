<?php

namespace App\Http\Requests;

use App\Models\Admin\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $size = Language::count();
        $requiredString = 'required|string';
        $nullableString = 'nullable|string';
        $nullableInt = 'nullable|integer';
        $id = 0;
        if ($request->product && isset($request->product->id)) {
            $id = $request->product->id;
        }
        return [
            'product_type' => $requiredString,
            'product_slug' => $nullableString,
            'video_url' => $nullableString,
            'sku' => 'required|unique:products,sku,' . $id,
            'gallary_id' => 'required|exists:gallary,id',
            'gallary_detail_id' => 'required|array|exists:gallary,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            // 'box_size' => 'integer|required',
            // 'width' => 'numeric|required',
            // 'length' => 'numeric|required',
            // 'colors' => 'array|required',.
            // 'shade' => 'string|required',
            'material' => 'integer|required',
            // 'finish' => 'integer|required',
            // 'look_trend' => 'integer|required',
            // 'shape' => 'string|required',
            'made_in_usa' =>'integer|required',
            'applications' => 'array|required',
            // 'box_size' => 'integer|required',
            // 'specialty' => 'string|required',
            'product_status' => 'in:DEFAULT,active,inactive',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'tax_id' => 'nullable|integer|exists:taxes,id',
            'product_view' => $nullableInt,
            'is_featured' => 'in:DEFAULT,0,1',
            // 'is_points' => 'in:DEFAULT,0,1',
            'product_min_order' => $nullableInt,
            'product_max_order' => $nullableInt,
            'seo_meta_tag' => 'nullable|string|max:255',
            'seo_desc' => 'nullable|string|max:255',
            'language_id' => 'required|array|exists:languages,id|size:' . $size,
            // 'title' => 'required|array|size:' . $size,
            // 'desc' => 'required|array|size:' . $size,
            'title' => 'required|array',
            'desc' => 'required|array',
            'category_id' => 'required|array|exists:categories,id',
        ];
    }

    public function attribute()
    {
        return [
            'attributes' => 'required|array|exists:attributes,id',
        ];
    }
}
