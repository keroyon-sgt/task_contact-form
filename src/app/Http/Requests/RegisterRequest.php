<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel' => ['required', 'numeric', 'digits_between:10,11'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'name.string' => '名前は文字列で入力してください',
            'name.max' => '名前は255文字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスは文字列で入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.max' => 'メールアドレスは255文字以下で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.max' => 'パスワードは255文字以下で入力してください',
        ];
    }
}
