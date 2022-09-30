<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'email_verified_at' => null,
            'password' => '$2y$10$I9.eq2UsGT5mS5ZDBoJBBeIiCj6oQKNM7BH6Q/TIyBIl5Qb1fMW6a',
            'postal_code' => '113-0033',
            'pref_id' => '13',
            'city' => '文京区',
            'town' => '本郷2-14-14',
            'building' => 'ユニテビル4F',
            'phone_number' => '03-3868-0927'
        ]);
    }
}
