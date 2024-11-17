<?php

namespace Database\Seeders;

use App\Models\PermissionSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionSetting::create([
            'email_verification' => 0,
            'kyc_verification' => 0,
            'two_fa_verification' => 0,
            'account_creation' => 0,
            'user_deposit' => 0,
            'user_withdraw' => 0,
            'user_send_money' => 0,
            'user_referral' => 0,
            'signup_bonus' => 0,
            'investment_referral_bounty' => 0,
            'deposit_referral_bounty' => 0,
            'site_animation' => 0,
            'site_back_to_top' => 0,
            'development_mode' => 0
        ]);
    }
}
