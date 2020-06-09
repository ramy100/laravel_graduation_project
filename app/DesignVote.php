<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignVote extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'design_id', 'user_id'
    ];

    //
    public function design()
    {
        return $this->belongsTo(Design::class,'design_id');
    }
    public function voter()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
