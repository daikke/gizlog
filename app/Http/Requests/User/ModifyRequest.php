<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ModifyRequest extends FormRequest
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
            'reason' => [
                'required',
                'max:500'
            ],
            'registration_date' => [
                'required',
                'before_or_equal:today'
            ],
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
            'required' => '入力必須の項目です。',
            'max' => ':max 文字以内で入力してください。',
            'before_or_equal' => '今日以前の日付で入力してください。',
        ];
    }
}
