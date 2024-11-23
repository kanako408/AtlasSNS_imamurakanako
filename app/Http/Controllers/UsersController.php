<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index(Request $request)
    {

        // $queryを初期化
        $query = User::query();

        // 検索ワードがある場合、部分一致で検索
        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->input('search') . '%');
        }

        // 自分以外のユーザーを取得
        $users = $query->where('id', '!=', auth()->id())->get();

        return view('users.search', compact('users'));
    }
}
