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

        // フォロー対象のユーザーが存在するか確認
        $targetUser = User::findOrFail($id);

        // フォローしているか確認
        $isFollowing = $user->follows()->where('followed_id', $id)->exists();

        if ($isFollowing) {
            // フォロー解除
            $user->follows()->where('followed_id', $id)->delete();
        } else {
            // フォローする
            $user->follows()->create(['followed_id' => $id]);
        }

        // return redirect()->back();
        return redirect()->back()->with('success', 'フォロー状態が変更されました');
    }
}
