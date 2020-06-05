<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    // need to set many to many relation
    protected $guarded = [];
    use SoftDeletes;
    
}
