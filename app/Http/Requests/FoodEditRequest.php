<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodEditRequest extends FormRequest
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
            'food_group'=>'required',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '提供料理名を入力してください。',
            'description.required' => '提供料理情報を入力してください。',
            'food_group.required' => 'フードグループを一つ以上選択して下さい',
            
        ];
        
    }
}
