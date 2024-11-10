<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
   public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|string|min:1|max:150',
        ]);

        // 投稿の登録処理
        Post::create([
            'user_id' => Auth::id(),
            'post' => $request->content,
        ]);

        // トップページにリダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が完了しました');
    }

    public function index()
{
     // 投稿一覧を取得する（例: すべての投稿）
        $posts = Post::latest()->get();

        // ビューにデータを渡す
        return view('posts.index', compact('posts'));
    // // ログインユーザーとそのフォローしているユーザーの投稿を取得
    // $posts = Post::whereIn('user_id', Auth::user()->following()->pluck('id')->push(Auth::id()))
    //              ->latest()
    //              ->get();

    // return view('posts.index', compact('posts'));
}

// 投稿削除
public function destroy(Post $post)
{
    // ログインユーザーのみ削除可能
    if ($post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', '投稿を削除しました');
}
//
    // public function index(){
    //     return view('posts.index');
    // }
}
