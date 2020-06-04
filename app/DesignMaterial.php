<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignMaterial extends Model
{
    //
    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }
    public function design()
    {
        return $this->belongsTo(Design::class,'design_id');
    }
}
