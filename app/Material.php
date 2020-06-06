<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Design;

class Material extends Model
{
    // need to set many to many relation
    protected $guarded = [];
    use SoftDeletes;


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
    
}
