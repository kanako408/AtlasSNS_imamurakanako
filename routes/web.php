<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
// ログイン
use App\Http\Controllers\Auth\RegisteredUserController;
// 新規ユーザー登録

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// require __DIR__ . '/auth.php';

// Route::get('top', [PostsController::class, 'index']);

// Route::get('profile', [ProfileController::class, 'profile']);

// Route::get('search', [UsersController::class, 'index']);

// Route::get('follow-list', [PostsController::class, 'index']);
// Route::get('follower-list', [PostsController::class, 'index']);

// 追加: auth ミドルウェアでアクセス制限を設定
Route::middleware(['auth'])->group(function () {
    Route::get('top', [PostsController::class, 'index'])->name('index');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('search', [UsersController::class, 'index'])->name('search');
    Route::get('follow-list', [PostsController::class, 'followList'])->name('follow-list');
    Route::get('follower-list', [PostsController::class, 'followerList'])->name('follower-list');
    Route::get('users/{user}/profile', [UsersController::class, 'show'])->name('user-profile');
        // 投稿関連のルート
    Route::resource('posts', PostsController::class)->only(['index', 'store', 'destroy']);
});

// 新規ユーザー登録
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// ログイン
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// 登録ページとログインページへのGETリクエストでフォームを表示し、POSTリクエストで処理が実行

// 新規登録後のページ
Route::get('added', [RegisteredUserController::class, 'added']);
// added ページにリダイレクトするため、web.php に added ルートが定義


// ログアウトのルート
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
