<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    // 中間テーブルを指定
    protected $table = 'follows';
    // タイムスタンプ（created_at, updated_at）を利用する場合は true
    public $timestamps = true;
    // 更新可能なカラムを定義
    protected $fillable = ['following_id', 'followed_id'];
    // フォローしているユーザー
    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
    // フォローされているユーザー
    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
