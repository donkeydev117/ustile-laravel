<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationAlt extends Model
{
    use HasFactory;
    protected $table = 'product_variations_alt';

    protected $guard = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Admin\Product');
    }    
    
}
