<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductApplication extends Model
{
    use HasFactory;

    protected $table  = 'applications';
    protected $guarded = [];

    public function gallary()
    {
        return $this->belongsTo('App\Models\Admin\Gallary', 'image', 'id');
    }
}
