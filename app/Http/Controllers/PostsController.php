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
        ], [
            'content.required' => '投稿内容は必須です。',
            'content.string' => '投稿内容は文字列でなければなりません。',
            'content.min' => '投稿内容は1文字以上でなければなりません。',
            'content.max' => '投稿内容は150文字以下でなければなりません。',
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
        // $posts = Post::latest()->get();

        // ビューにデータを渡す
        // return view('posts.index', compact('posts'));
        //  auth()->user()->followings()：ログインユーザーとそのフォローしているユーザーの投稿を取得
        // pluck('id')：フォローしているユーザーのIDだけを抽出します。
        // push(Auth::id())：自分のIDをリストに追加します。
        $userIds = auth()->user()->followings()->pluck('users.id'); // フォロー中のユーザーIDを取得
        $userIds->push(Auth::id()); // 自分のIDを追加

        // whereIn('user_id', ...)：フォローしているユーザーと自分の投稿をフィルタリングします。
        $posts = Post::whereIn('user_id', $userIds)
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
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
    // 投稿更新
    public function update(Request $request,)
    {
        // バリデーションを追加
        $request->validate([
            'upPost' => 'required|string|min:1|max:150',
        ], [
            'upPost.required' => '投稿内容は必須です。',
            'upPost.string' => '投稿内容は文字列でなければなりません。',
            'upPost.min' => '投稿内容は1文字以上でなければなりません。',
            'upPost.max' => '投稿内容は150文字以下でなければなりません。',
        ]);

        // // 投稿の更新★
        // $post->update([
        //     'post' => $request->input('upPost'),
        // ]);

        $id = $request->input('Id');
        $up_post = $request->input('upPost');

        // 更新処理
        Post::where('id', $id)->update([
            //最後に書いてある「->update();」で、フォームから持ってきた$up_title変数と$up_price変数の値にそれぞれ更新
            'user_id' => Auth::id(), // ログインユーザーのIDを設定
            'post' => $up_post,
        ]);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました');
        // リダイレクトでindexのURLを指定、トップページに戻る
    }
    // フォローリストへの投稿表示
    public function show()
    {
        // ログインユーザーがフォローしているユーザーのIDを取得
        $following_ids = Auth::user()->follows()->pluck('followed_id');

        // フォローしているユーザーの投稿を取得 (投稿者情報を含める)
        $posts = Post::with('user') // 投稿とユーザー情報を一緒に取得
            ->whereIn('user_id', $following_ids) // フォローしているユーザーの投稿に絞り込む
            ->latest() // 投稿日時の降順で取得
            ->get();

        // // デバッグ用コード
        // dd($following_ids, $posts);

        // ビューにデータを渡す
        return view('follows.followList', [
            'posts' => $posts, // 投稿データ
            'followings' => Auth::user()->follows()->get() // フォロー中のユーザー
        ]);
    }
}
