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
        $userToFollow = User::findOrFail($id);
        $authUser = auth()->user();

        // フォローしている場合は解除
        if ($authUser->isFollowing($userToFollow)) {
            $authUser->followings()->detach($userToFollow->id);
        } else {
            Follow::create([
                'following_id' => $authUser->id,
                'followed_id' => $userToFollow->id,
            ]);
        }

        return redirect()->back();
    }
}
