<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignImage extends Model
{
    //
    public function design()
    {
        return $this->belongsTo(Design::class,'design_id');
    }
}
