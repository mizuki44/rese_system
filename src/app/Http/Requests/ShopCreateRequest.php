<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopCreateRequest extends FormRequest
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
            'name' => 'required|min:2|max:20',
            'area_id' => 'required ',
            'genre_id' => 'required',
            'description' => 'required|min:5|max:300',
            'image_url' => 'required',
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
            'name.required' => ':attributeは必須項目です。',
            'name.min' => ':attributeは最低:min文字以上で入力してください。',
            'name.max' => ':attributeは最大:max文字以内で入力してください。',
            'area_id.required' => ':attributeは必須項目です。',
            'genre_id.required' => ':attributeは必須項目です。',
            'description.required' => ':attributeは必須項目です。',
            'description.min' => ':attributeは最低:min文字以上で入力してください。',
            'description.max' => ':attributeは最大:max文字以内で入力してください。',
            'image_url.required' => ':attributeは必須項目です。',
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
            'name' => '店舗名',
            'area_id' => 'エリア',
            'genre_id' => 'ジャンル',
            'description' => '説明文',
            'image_url' => 'イメージ画像',

        ];
    }
}
