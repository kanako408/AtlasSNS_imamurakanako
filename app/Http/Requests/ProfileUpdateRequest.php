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
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|string|email|max:40|unique:users,email,' . $this->user()->id,
            'password' => 'nullable|string|min:8|max:20|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'bio' => 'nullable|string|max:150',
            'icon_image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg|max:2048',
        ];
    }
}
