<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount','bank_name','bank_account_number','bank_owner_name','paypal_email','method'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'designer_id');
    }
}
