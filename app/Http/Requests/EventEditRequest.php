<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventEditRequest extends FormRequest
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
            
        ];
        
            
        
    }

    public function messages()
    {
        return[
            'name.required' => '{{App\Consts\ReuseConst::EVENT}}名を入力してください。',
            'price_adult.required' => '大人料金を入力して下さい',
            'price_child.required' => '子供料金を入力して下さい',
            'address.required' => '住所を入力して下さい',
            'phone.required' => '連絡先情報を入力して下さい',
            'description.required' => '説明を入力して下さい',
            'detail.required' => '{{App\Consts\ReuseConst::EVENT}}詳細を入力して下さい',
            'caution.required' => '注意事項を入力して下さい',
            'hotel_result.min' => 'ホテルグループを一つ以上選択して下さい',
            'food_result.min' => 'フードグループを一つ以上選択して下さい',

        ];
        
    }
}
