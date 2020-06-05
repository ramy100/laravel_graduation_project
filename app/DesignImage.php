<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignImage extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'design_id', 'image'
    ];
    //
    public function design()
    {
        return $this->belongsTo(Design::class,'design_id');
    }
}
