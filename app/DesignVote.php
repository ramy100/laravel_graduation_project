<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignVote extends Model
{
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
