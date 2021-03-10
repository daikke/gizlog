<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'content'           => 'required|max:1000',
            'title'             => 'required|max:255',
            'tag_category_id'   => 'required|exists:tag_categories,id',
        ];
    }

    /**
     * custom message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'content.required'         => '入力必須の項目です。',
            'content.max'              => ':max文字以内で入力してください。',
            'title.required'           => '入力必須の項目です。',
            'title.max'                => ':max文字以内で入力してください。',
            'tag_category_id.required' => '入力必須の項目です。',
            'tag_category_id.exists'   => 'カテゴリが存在しません。',
        ];
    }
}
