<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookCsvRequest extends FormRequest
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
        $postData = $this->all();
        return [
            'csv'  => 'required|mimes:txt,csv|max:110', // mimeタイプ指定のため、txtも指定必要
        ];
    }

    public function messages()
    {
        return [
            'csv.required' => '入力必須の項目です。',
            'csv.mimes'   => 'CSVファイルを選択して下さい。',
            'csv.max'   => ':maxKB以内にしてください。',
        ];
    }
}
