<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission作成
        //$perm1 = Permission::create(['name' => 'SiteMaster_read']);
		//$perm2 = Permission::create(['name' => 'Partner_read']);

        // Role作成
		$role_admin = Role::create(['name' => 'system_admin']);
		$role_user = Role::create(['name' => 'site_admin']);
        $role_admin = Role::create(['name' => 'partner']);
		$role_user = Role::create(['name' => 'user']);

		// PermissionとRoleを関連付け
		//$role_admin->givePermissionTo('SiteMaster_read');
        //$role_admin->givePermissionTo('Partner_read');
		//$role_user->givePermissionTo('Partner_read');

		// User作成
        $user1 = \App\Models\User::where('id', 1)->first();

        $user2 = \App\Models\User::create([
            'name' => 'サイト管理者',
            'email' => 'user2@test.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass1234'),
            'postal_code' => '000-0033',
            'pref_id' => '13',
            'city' => 'サンプル区',
            'town' => 'サンプル5丁目',
            'building' => 'ビル5F',
            'phone_number' => '00-0000-0000'
        ]);

        $user3 = \App\Models\User::create([
            'name' => 'パートナー',
            'email' => 'user3@test.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass1234'),
            'postal_code' => '000-0033',
            'pref_id' => '12',
            'city' => 'サンプル市',
            'town' => 'サンプル6丁目',
            'building' => 'ビル9F',
            'phone_number' => '00-0000-0000'
        ]);

        $user4 = \App\Models\User::create([
            'name' => '一般ユーザ',
            'email' => 'user4@test.com',
            'email_verified_at' => null,
            'password' => Hash::make('pass1234'),
            'postal_code' => '000-0033',
            'pref_id' => '14',
            'city' => 'サンプルサンプル市',
            'town' => 'サンプル7丁目',
            'building' => 'ビル1F',
            'phone_number' => '00-0000-0000'
        ]);

		// UserにRoleを割り当て
		$user1->assignRole('system_admin');
		$user2->assignRole('site_admin');
        $user3->assignRole('partner');
        $user4->assignRole('user');

        //パートナーを登録
        \App\Models\Partner::create([
            'user_id' => $user3->id,
            'name' => $user3->name,
        ]);

        
    }
}
