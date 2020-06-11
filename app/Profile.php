<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'user_id','website','about','document','is_verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
