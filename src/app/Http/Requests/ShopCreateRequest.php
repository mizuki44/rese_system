<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
            'area_id' => 'required',
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
    public function messages()
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

    public function rules_for_csv()
    {
        return [
            'name' => 'required|min:2|max:50',
            'area' => ['required', Rule::in(['東京都', '大阪府', '福岡県'])],
            'genre' => ['required', Rule::in(['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'])],
            'description' => 'required|min:5|max:400',
            'image_url' => ['active_url', 'ends_with:.jpeg,.jpg,.png'],
        ];
    }
    public function messages_for_csv()
    {
        return [
            'name.required' => ':attributeは必須項目です。',
            'name.min' => ':attributeは最低:min文字以上で入力してください。',
            'name.max' => ':attributeは最大:max文字以内で入力してください。',
            'area.required' => ':attributeは必須項目です。',
            'genre.required' => ':attributeは必須項目です。',
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
    public function attributes()
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
