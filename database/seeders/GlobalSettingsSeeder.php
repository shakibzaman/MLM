<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('global_settings')->insert([
            'site_logo' => 'uploads/images/site_logo.png',  // example image path
            'site_fevicon' => 'uploads/images/site_fevicon.ico',  // example image path
            'admin_login_cover' => 'uploads/images/admin_login_cover.jpg',  // example image path
            'site_admin_prefix' => 'admin',
            'site_currency_type' => 'USD',
            'site_currency' => 'Dollar',
            'timezon' => 'UTC',
            'referral_type' => 'percentage',
            'currency_symbol' => '$',
            'referral_code_Limit' => '5',
            'home_redirect' => 'dashboard',
            'site_title' => 'My Website',
            'site_email' => 'info@mywebsite.com',
            'support_email' => 'support@mywebsite.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
