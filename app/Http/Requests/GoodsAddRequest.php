<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsAddRequest extends FormRequest
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
            'description'=>'required',
            'detail'=>'required',
            'caution'=>'required', 
            'goods_name'=>'required',
            'goods_price'=>'required',
            'goods_description'=>'required',
            'goods_sort_no'=>'required',
            'goods_quantity'=>'required',

        ];
    }

    public function messages()
    {
        return[
            'name.required' => '商品名を入力してください。',
            'price.required' => '標準商品価格を入力して下さい',
            'description.required' => '説明を入力して下さい',
            'phone.required' => '連絡先情報を入力して下さい',
            'detail.required' => '詳細情報を入力して下さい',
            'caution.required' => '注意事項を入力して下さい',
            'goods_name.required' => '商品種別名を入力してください。',
            'goods_price.required' => '商品価格を入力して下さい',
            'goods_description.required' => '商品説明を入力して下さい',
            'goods_sort_no.required' => 'ソートナンバーを入力して下さい',
            'goods_quantity.required' => '商品個数を入力して下さい',

        ];
        
    }
}

