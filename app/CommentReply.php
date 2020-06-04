<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
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
