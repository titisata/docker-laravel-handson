<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelEditRequest extends FormRequest
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
            'address'=>'required|string',
            'mail'=>'required|email',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'ホテル名を入力してください。',
            'description.required' => 'ホテル情報を入力してください。',
            'address.required' => '住所を入力してください。',
            'mail.required' => 'メールアドレスを入力してください。',
        ];
        
    }
}
