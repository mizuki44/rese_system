<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSendRequest extends FormRequest
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
            'title' => 'required|max:20',
            'content' => 'required',
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
            'title.required'  => ':attributeは必須項目です。',
            'title.max'       => ':attributeは最大:max文字以内で入力してください。',
            'content.required' => ':attributeは必須項目です。',
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
            'title' => 'タイトル',
            'content' => '内容',

        ];
    }
}
