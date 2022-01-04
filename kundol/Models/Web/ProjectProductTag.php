<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProductTag extends Model
{
    use HasFactory;
    protected $table = "project_products_tags";
    protected $guarded = [];
}
