<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_settings')->insert([
            'min_password_length' => '8',  // example image path
            'max_password_length' => '15',  // example image path
            'password_for_withdraw' => '0',  // example image path
            'confirm_code_account_update' => '0',
            'notify_status' => '0',
            'subscription_type' => 'monthly',
            'password_for_edit_profile' => '0',
            'email_change_status' => '0',
            'subscription_status' => '0',
            'subscription_grace_period' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
