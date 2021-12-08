<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LookTrend extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'key', 'name', 'media'
    ];
}
