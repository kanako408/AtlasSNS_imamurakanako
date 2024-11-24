<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function followerList()
    {
        return view('follows.followerList');
    }


    public function toggleFollow($id)
    {
        // ログインユーザー
        $user = auth()->user();

        // フォローする対象のユーザー
        $targetUser = User::findOrFail($id);

        if ($user->isFollowing($targetUser)) {
            // フォローしている場合 → フォロー解除
            $user->followings()->detach($targetUser->id);
        } else {
            // フォローしていない場合 → フォロー
            $user->followings()->attach($targetUser->id);
        }

        return back()->with('status', 'フォロー状態を変更しました。');
    }
}
