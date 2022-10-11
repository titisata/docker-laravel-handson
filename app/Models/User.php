<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code', 
        'pref_id', 
        'city', 
        'town', 
        'building', 
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reserved_experiences()
    {
        return $this->hasMany(ExperienceReserve::class);
    }

    public function future_reserved_experiences()
    {
        $now = now()->format('y-m-d');

        return $this->hasMany(ExperienceReserve::class)->where('start_date', '>=', $now);
    }

    /**
     * ロールを取得する
     *
     * @return Collection<Role>
     */
    // public function roles()
    // {
    //     return $this->hasMany(Role::class);
    // }

    public function ordered_goods()
    {
        return $this->hasMany(GoodsOrder::class);
    }

    // public function future_ordered_goods()
    // {

    //     $now = now()->format('y-m-d');
        
    //     return $this->hasMany(GoodsOrder::class)->where('start_date', '<', $now)->get();
    // }

    /**
     * 体験を取得
     *
     * @return Collection<ExperienceFolder>
     */

    public function experiences()
    {
        return $this->hasMany(ExperienceFolder::class);
    }

    /**
     * グッズを取得
     *
     * @return Collection<GoodsFolder>
     */

    public function goods()
    {
        return $this->hasMany(GoodsFolder::class);
    }

    public function role_string()
    {
        $user_roles = array();
        $user_roles_object = $this->getRoleNames();
        foreach($user_roles_object as $role_name){
            $user_roles[] = $role_name;
        }
        return implode(',', $user_roles);
    }

    /**
     * 都道府県リスト
     *
     * @var array
     */
    public static $prefs = [
        1 => '北海道',
        2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県',
        8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県',
        15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県',
        21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県',
        25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県',
        31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県',
        36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県',
        40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県',
    ];
}
