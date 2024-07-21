<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'course_name' => 'required',
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
            'course_name.required' => ':attributeは必須項目です。',
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
            'course_name' => 'コース名',
        ];
    }
}
