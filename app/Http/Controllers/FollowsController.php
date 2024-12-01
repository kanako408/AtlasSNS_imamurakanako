<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $user = auth()->user(); // 現在のログインユーザー
        $followings = $user->followings; // フォローしているユーザー一覧
        // / ビューにデータを渡す
        return view('follows.followList', compact('followings', 'user'));
    }



    public function toggleFollow($id)
    {
        // ログインユーザー
        $user = auth()->user();

        // フォロー対象のユーザーが存在するか確認
        $targetUser = User::findOrFail($id);

        // フォローしているか確認
        $isFollowing = $user->follows()->where('followed_id', $id)->exists();
        // detach/attach多対多リレーションにおけるデータの追加・削除
        if ($isFollowing) {
            // フォロー解除
            $user->follows()->detach($id);
        } else {
            // フォローする
            $user->follows()->attach($id);
        }

        // return redirect()->back();
        return redirect()->route('search');
    }
}
