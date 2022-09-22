<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'site_name'=>'required',
            'shop_num'=>'required|numeric|between:0,100',
            'regist_num'=>'required|numeric|between:0,100',
            'recommend_limit'=>'required|numeric|between:0,100',
            'comment'=>'required',
            'site_color'=>'nullable',
            'sales_copy'=>'required',
        ];
        
    }

    public function messages()
    {
        return[
            'site_name.required' => 'サイト名を入力してください。',
            'shop_num.required' => '登録可能店舗数を入力してください。',
            'regist_num.required' => '商品登録上限数を入力してください。',
            'recommend_limit.required' => 'おすすめ表示上限数を入力してください。',
            'comment.required' => 'コメントを入力してください。',
            'sales_copy' => 'セールスコピーを入力してください。',
        ];
        
    }
}
