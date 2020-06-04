<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignerRate extends Model
{
    //
    public function voter()
    {
        return $this->belongsTo(User::class,'liker_id');
    }

    public function designer()
    {
        return $this->belongsTo(User::class,'designer_id');
    }
}
