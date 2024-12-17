<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio', // bio
        'icon_image', // icon_image
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //リレーション定義を追加
    //「１対多」の「多」側 → メソッド名は複数形でhasManyを使う
    public function posts()
    { //User.phpにとってpost.phpは「多」
        return $this->hasMany('App\Models\Post');
    }
    // これにより、ビューではそのまま {{ $user->icon_url }} を使用
    public function getIconUrlAttribute()
    {
        // 存在する場合はその画像を表示
        // 存在しない場合（null や空文字）はデフォルト画像 default-icon.png を返す。
        // asset() 関数は public ディレクトリを基準としたURLを生成
        return $this->icon_image
            ? asset('storage/' . $this->icon_image)
            : asset('storage/icon1.png');
    }
    // followsリレーション: ユーザーがフォローしているユーザーを取得する多対多リレーション。
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    // フォローリスト
    // フォローしているユーザー（自分がフォローしている人）を取得
    public function followings()
    {
        // 自分がフォローしているユーザー
        return $this->belongsToMany(
            User::class, // 関連付け先のモデル
            'follows', // 中間テーブル名
            'following_id', // 中間テーブルの「自分のID」を指すカラム
            'followed_id' // 中間テーブルの「フォロー先のユーザーID」を指すカラム
        );
    }

    // 自分をフォローしているユーザーを取得
    public function followers()
    {
        return $this->belongsToMany(
            User::class, // 関連付け先のモデル
            'follows',   // 中間テーブル名
            'followed_id', // 自分のIDが保存されているカラム
            'following_id' // フォローしているユーザーのID
        );
    }

    public function isFollowing(User $user)
    {
        return $this->followings->contains($user);
    }

    // public function isFollowedBy(User $user)
    // {
    //     // フォローされているかを判定
    //     return $this->followers()->where('following_id', $user->id)->exists();
    // }
}
