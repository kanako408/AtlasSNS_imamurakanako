<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post'
    ];

    // 投稿の所有者（ユーザー）を取得
    public function user()
    { //post.phpにとってuser.phpは「１」
        return $this->belongsTo('App\Models\User');
    }
}
