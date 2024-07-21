<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required|max:20',
            'email' => 'required | email',
            'password' => 'required',
            'role' => 'required',
        ];
    }

    /**
     * バリデーションエラーメッセージを定義
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'  => ':attributeは必須項目です。',
            'name.max'       => ':attributeは最大:max文字以内で入力してください。',
            'email.required' => ':attributeは必須項目です。',
            'email.email'    => ':attributeを正しく入力してください。',
            'password.required'  => ':attributeは必須項目です。',
            'role.required'  => ':attributeは必須項目です。',
        ];
    }

    /**
     * カスタム属性名を定義
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => '氏名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'role' => 'role',

        ];
    }
}
