<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;
    protected $guarded = [];
    protected $with = ['owner','favorites'];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');//使用user_id进行关联
    }

}
