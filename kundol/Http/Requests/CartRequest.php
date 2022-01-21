<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'product_combination_id' => 'nullable|integer|exists:product_variations_alt,id',
            'qty' => 'exclude_if:product_type,digital|required|integer',
            'is_sample' => 'nullable|integer',
        ];
    }
}
