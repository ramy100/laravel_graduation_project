<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDesign extends Model
{
    //
    protected $fillable = [
        'design_id', 'link', 'image' , 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(User::class,'company_id');
    }
    public function design()
    {
        return $this->belongsTo(Design::class,'design_id');
    }
}
