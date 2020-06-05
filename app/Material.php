<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Design;

class Material extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

	public function designs()
    {
        return $this->belongsToMany(Design::class,'design_materials');
    }
    //
    
}
