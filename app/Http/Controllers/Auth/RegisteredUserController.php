<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        // バリデーションルールを追加
        $request->validate([
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|string|email|min:5|max:40|unique:users,email',
            'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
        ], [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上でなければなりません。',
            'username.max' => 'ユーザー名は12文字以下でなければなりません。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.min' => 'メールアドレスは5文字以上でなければなりません。',
            'email.max' => 'メールアドレスは40文字以下でなければなりません。',
            'email.unique' => 'そのメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.alpha_num' => 'パスワードは英数字のみを含む必要があります。',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.max' => 'パスワードは20文字以下でなければなりません。',
            'password.confirmed' => 'パスワード確認が一致しません。',
        ]);

        // ユーザー作成
        try {
            $user = User::create([ // $user変数に格納
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $e) {
            // エラーが発生した場合、エラーメッセージを表示する
            return back()->withErrors(['message' => 'ユーザーの作成に失敗しました。']);
        }
        // 作成したユーザー名をビューに渡す
        return redirect('added')->with('username', $user->username);
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
