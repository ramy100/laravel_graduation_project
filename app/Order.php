<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function subOrders()
    {
        return $this->hasMany('App\SubOrder');
    }
}
