<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent(){
        return $this->hasOne('App\Models\Web\Project', 'id', 'parent_id');
    }
}
