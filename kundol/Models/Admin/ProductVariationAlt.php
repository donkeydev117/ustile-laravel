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

    public function media()
    {
        return $this->hasOne(Gallary::class, 'id', "media_id");
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color');
    }

    public function shade()
    {
        return $this->hasOne(Shade::class, 'id', 'shade');
    }

    public function finish()
    {
        return $this->hasOne(Finish::class, 'id', 'finish');
    }

    public function look()
    {
        return $this->hasOne(LookTrend::class, 'id', 'look');
    }

    public function shape()
    {
        return $this->hasOne(Shape::class, 'id', 'shape');
    }

}
