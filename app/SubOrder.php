<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    protected $guarded=[];
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
