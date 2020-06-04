<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    //
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function designer()
    {
        return $this->belongsTo(User::class,'designer_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class,'company_id');
    }

    public function comments()
    {
        return $this->hasMany(DesignComment::class,'design_id');
    }

    public function images()
    {
        return $this->hasMany(DesignImage::class,'design_id');
    }

    public function materials()
    {
        return $this->hasMany(DesignMaterial::class,'design_id');
    }

    public function votes()
    {
        return $this->hasMany(DesignVote::class,'design_id');
    }
    
}
