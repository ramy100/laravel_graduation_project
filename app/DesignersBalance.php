<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignersBalance extends Model
{
    //
    protected $fillable = [
        'designer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'designer_id');
    }
}
