<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventAddRequest extends FormRequest
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
            'price_adult'=>'required|integer',
            'price_child'=>'required|integer',
            'address'=>'required',
            'phone'=>'required',
            'description'=>'required',
            'detail'=>'required',
            'caution'=>'required',
            'hotel_result'=>'numeric|min:1',
            'food_result'=>'numeric|min:1',
            'ex_name'=>'required',
            'ex_price_adult'=>'required',
            'ex_price_child'=>'required',
            'ex_sort_no'=>'required',
            'ex_quantity'=>'required',
            
        ];
        
            
        
    }

    public function messages()
    {
        return[
            'name.required' => 'イベント名を入力してください。',
            'price_adult.required' => '大人料金を入力して下さい',
            'price_child.required' => '子供料金を入力して下さい',
            'address.required' => '住所を入力して下さい',
            'phone.required' => '連絡先情報を入力して下さい',
            'description.required' => '説明を入力して下さい',
            'detail.required' => 'イベント詳細を入力して下さい',
            'caution.required' => '注意事項を入力して下さい',
            'hotel_result.numeric|min:1' => 'ホテルグループを一つ以上選択して下さい',
            'food_result.numeric|min:1' => 'フードグループを一つ以上選択して下さい',
            'ex_name.required' => '体験名を入力してください。',
            'ex_price_adult.required' => '大人料金を入力して下さい',
            'ex_price_child.required' => '子供料金を入力して下さい',
            'ex_sort_no.required' => 'ソートナンバーを入力して下さい',
            'ex_quantity.required' => '体験可能人数を入力して下さい',

        ];
        
    }
}
