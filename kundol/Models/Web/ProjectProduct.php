<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(){
        return $this->hasOne("App\Models\Web\Project", 'id', 'project_id');
    }

    public function product(){
        return $this->hasOne("App\Models\Admin\Product", 'id', 'product_id')->with('detail')->with("gallary")->with("gallary.detail");
    }

    public function tags(){
        return $this->hasMany("App\Models\Web\ProjectProductTag");
    }



}
