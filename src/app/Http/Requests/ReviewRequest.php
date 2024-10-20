<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'star' => 'required',
            'comment' => 'required|max:400',
            'image_url' => 'mimes:jpeg,png,jpg',
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
            'star.required' => ':attributeは必ず選択してください',
            'comment.required' => ':attributeは必ず入力してください',
            'comment.max' => ':attributeは最大:max文字以内で入力してください。',
            'image_url.mimes' => ':attributeは拡張子がjpeg、pngのみアップロード可能です。',


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
            'star' => '星',
            'comment' => 'コメント',
            'image_url' => 'イメージ画像',
        ];
    }
}
