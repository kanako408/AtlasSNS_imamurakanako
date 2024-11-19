<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認証済みユーザーのみ実行可能
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:12'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:40', Rule::unique('users', 'email')->ignore($this->user()->id)],
            'password' => ['required', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/', 'confirmed'],
            'bio' => ['nullable', 'string', 'max:150'],
            'icon_image' => ['nullable', 'image', 'mimes:jpg,png,bmp,gif,svg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上でなければなりません。',
            'username.max' => 'ユーザー名は12文字以内でなければなりません。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.min' => 'メールアドレスは5文字以上でなければなりません。',
            'email.max' => 'メールアドレスは40文字以内でなければなりません。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.max' => 'パスワードは20文字以内でなければなりません。',
            'password.regex' => 'パスワードは英数字のみ使用できます。',
            'password.confirmed' => 'パスワード確認が一致しません。',
            'bio.max' => '自己紹介文は150文字以内でなければなりません。',
            'icon_image.image' => 'アイコン画像は画像ファイルでなければなりません。',
            'icon_image.mimes' => 'アイコン画像はjpg, png, bmp, gif, svgの形式でなければなりません。',
            'icon_image.max' => 'アイコン画像のサイズは2MB以内にしてください。',
        ];
    }
}
