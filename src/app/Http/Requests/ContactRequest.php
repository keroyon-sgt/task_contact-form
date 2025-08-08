<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'integer','max:3'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'tel' => ['required', 'numeric', 'digits_between:10,11'],
            'tel-1' => ['required', 'numeric', 'digits_between:2,5'],
            'tel-2' => ['required', 'numeric', 'digits_between:1,4'],
            'tel-3' => ['required', 'numeric', 'digits:4'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['string', 'max:255','nullable'],
            'category_id' => ['required', 'integer'],
            'detail' => ['required', 'string'],//new MaxWordCountValidation(255)
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '名を入力してください',
            // 'first_name.string' => '名前は文字列で入力してください',
            // 'first_name.max' => '名前は255文字以下で入力してください',
            'last_name.required' => '姓を入力してください',
            // 'last_name.string' => '姓は文字列で入力してください',
            // 'last_name.max' => '姓は255文字以下で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            // 'email.string' => 'メールアドレスは文字列で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            // 'email.max' => 'メールアドレスは255文字以下で入力してください',
            // 'tel.required' => '電話番号を入力してください',
            // 'tel.numeric' => '電話番号は数値で入力してください',
            // 'tel.digits_between' => '電話番号は10桁から11桁の間で入力してください',

            'tel-1.required' => '市外局番を入力してください',
            // 'tel-1.numeric' => '電話番号は数値で入力してください',
            'tel-1.digits_between' => '電話番号は2桁から5桁の間で入力してください',
            'tel-2.required' => '市内局番を入力してください',
            // 'tel-2.numeric' => '電話番号は数値で入力してください',
            'tel-2.digits_between' => '電話番号は1桁から4桁の間で入力してください',
            'tel-3.required' => '加入者番号を入力してください',
            // 'tel-3.numeric' => '電話番号は数値で入力してください',
            'tel-3.digits_between' => '電話番号は4桁で入力してください',
            'address.required' => '住所を入力してください',
            // 'address.string' => '住所は文字列で入力してください',
            // 'address.max' => '住所は255文字以下で入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
