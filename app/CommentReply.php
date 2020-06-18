<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
	//
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'comment_id', 'user_id'
    ];
    
    //
    public function comment()
    {
        return $this->belongsTo(DesignComment::class,'comment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
