<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index(Request $request)
    {
        // ログイン中のユーザーIDを取得
        $currentUserId = auth()->id();

        // $queryを初期化
        $query = User::query();

        // 検索ワードがある場合、部分一致で検索
        if ($request->filled('search')) {
            $query->where(
                'username',
                'like',
                '%' . $request->input('search') . '%'
            );
        }
        // ログインユーザーを除外
        $query->where('id', '!=', $currentUserId);

        // 検索結果または全ユーザーを取得
        $users = $query->get();
        // 3つ目の処理：リダイレクトでindexのURLを指定して、ユーザーの一覧ページを画面表示するルーティング
        return view(
            'users.search',
            ['users' => $users]
        );
    }
}
