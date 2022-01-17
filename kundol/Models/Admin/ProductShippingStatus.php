<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShippingStatus extends Model
{
    use HasFactory;
    protected $table = "product_shipping_status";
    protected $fillable = ['product_id', 'shipping_status_id'];
    
}
