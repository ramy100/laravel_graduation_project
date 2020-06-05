<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    public function designs()
    {
        return $this->hasMany('App\Design');
    }
    protected $guarded = [];
    use SoftDeletes;
}
