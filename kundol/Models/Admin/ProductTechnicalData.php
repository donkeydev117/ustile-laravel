<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTechnicalData extends Model
{
    use HasFactory;

    protected $table = 'technial_data';
    protected $guarded = [];

    public function gallary()
    {
        return $this->belongsTo('App\Models\Admin\Gallary', 'image', 'id');
    }
}
