<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelGroupEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'description'=>'required|string',
            'price_adult'=>'required|numeric',
            'price_child'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'ホテルグループ名を入力してください。',
            'description.required' => '説明文を入力してください。',
            'price_adult.required' => '大人料金を入力してください。',
            'price_child.required' => '子供料金を入力してください。',
        ];
        
    }
}
