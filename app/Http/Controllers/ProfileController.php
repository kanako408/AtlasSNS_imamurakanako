<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profiles.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {

        // 現在ログインしているユーザーを取得
        $user = Auth::user();
        // ユーザーが存在するか確認
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
        // バリデーション済みデータを取得
        $validated = $request->validated();

        // デバッグ用
        // dd($validated);

        // 入力されたデータで更新
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');

        // パスワードが入力された場合のみ更新
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // アイコン画像のアップロード
        if ($request->hasFile('icon_image')) {
            // 既存画像を削除
            if ($user->icon_image) {
                Storage::delete($user->icon_image);
            }

            // 新しい画像を保存
            $path = $request->file('icon_image')->store('icons', 'public');
            $user->icon_image = $path;
        }
        //  データベースの保存
        /** @var \App\Models\User $user */
        $user->save();
        // プロフィールページへリダイレクト
        // return redirect()->route('index');
        return redirect()->route('index')->with('success', 'プロフィールを更新しました');
    }
}
