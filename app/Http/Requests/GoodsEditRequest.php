<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsEditRequest extends FormRequest
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
            'name'=>'required',
            'price'=>'required|integer',
            'address'=>'required',
            'description'=>'required',
            'detail'=>'required',
            'caution'=>'required',    
        ];
    }

    public function messages()
    {
        return[
            'name.required' => '商品名を入力してください。',
            'price.required' => '標準商品価格を入力して下さい',
            'address.required' => '住所を入力して下さい',
            'description.required' => '説明を入力して下さい',
            'detail.required' => '詳細情報を入力して下さい',
            'caution.required' => '注意事項を入力して下さい',

        ];
        
    }
}
