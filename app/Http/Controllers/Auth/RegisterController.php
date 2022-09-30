<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user->hasRole('system_admin|site_admin|partner')) {
            return '/mypage/partner/';
        }else{
            return '/mypage/user/';
        }
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


        /**
     * バリデーションエラーメッセージ
     *
     * @var array
     */
    protected $messages = [
        'name.required' => 'お名前を入力してください。',
        'name.max' => 'お名前は50文字以内で入力してください。',
        'email.required' => 'E-mailアドレスを入力してください。',
        'email.email' => '正しいE-mailアドレスを入力してください。',
        'email.max' => 'E-mailアドレスは255文字以内で入力してください。',
        'email.unique' => 'そのメールアドレスは既に登録されています。',
        'password.required' => 'パスワードを入力してください。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.confirmed' => '入力されたパスワードが一致しません。',
        'postal_code.required' => '郵便番号を入力してください。',
        'postal_code.regex' => '郵便番号は、半角数字3桁、半角ハイフン、半角数字4桁、の形式で入力してください。',
        'pref_id.required' => '都道府県を選択してください。',
        'city.required' => '市区町村を入力してください。',
        'city.max' => '市区町村は50文字以内で入力してください。',
        'town.required' => '町名番地等を入力してください。',
        'town.max' => '町名番地等は50文字以内で入力してください',
        'building.required' => '建物等は50文字以内で入力してください。',
        'phone_number.required' => '電話番号を入力してください。',
        'phone_number.regex' => '電話番号は、半角数字と半角ハイフンで入力してください。'
    ];

    /**
     * バリデーションルール
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
        'email' => ['required', 'string', 'email:rfc', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'postal_code' => ['required', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
        'pref_id' => ['required'],
        'city' => ['required', 'max:50',],
        'town' => ['required', 'max:50'],
        'building' => ['max:50'],
        'phone_number' => ['required', 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{4}$/'],
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules, $this->messages);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'postal_code' => $data['postal_code'],
            'pref_id' => $data['pref_id'],
            'city' => $data['city'],
            'town' => $data['town'],
            'building' => $data['building'],
            'phone_number' => $data['phone_number'],
        ]);
        $user->assignRole('user');
        return $user;
    }
}
