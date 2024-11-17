<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plugin_settings')->insert([
            ['name' => 'Tawk Chat', 'description' => 'Free Instant Messaging system', 'status' => 1, 'tawk_property_id' => '1ggi9vm2o', 'tawk_widget_id' => '635d5805b0d6371309cc36aa', 'google_recaptcha_key' => null, 'google_recaptcha_secret' => null, 'google_analytics_id' => null, 'fb_page_id' => null, 'pusher_app_id' => null, 'pusher_app_key' => null, 'pusher_secret' => null, 'pusher_cluster' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Google reCaptcha', 'description' => 'reCAPTCHA protects your website from fraud and abuse without creating friction', 'status' => 1, 'tawk_property_id' => null, 'tawk_widget_id' => null, 'google_recaptcha_key' => '6LdY0AgjAAAAAIe6cwoa8ReDAv-J0gCGMnwF9rDu', 'google_recaptcha_secret' => '6LdY0AgjAAAAAF6yK-wkguwwRVQB6AJmCS_QTl0P', 'google_analytics_id' => null, 'fb_page_id' => null, 'pusher_app_id' => null, 'pusher_app_key' => null, 'pusher_secret' => null, 'pusher_cluster' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Google Analytics', 'description' => 'Analytics will help you to collect data for your website', 'status' => 1, 'tawk_property_id' => null, 'tawk_widget_id' => null, 'google_recaptcha_key' => null, 'google_recaptcha_secret' => null, 'google_analytics_id' => '154514', 'fb_page_id' => null, 'pusher_app_id' => null, 'pusher_app_key' => null, 'pusher_secret' => null, 'pusher_cluster' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Facebook Messenger', 'description' => 'Messenger is a proprietary instant messaging app and platform developed by Meta', 'status' => 1, 'tawk_property_id' => null, 'tawk_widget_id' => null, 'google_recaptcha_key' => null, 'google_recaptcha_secret' => null, 'google_analytics_id' => null, 'fb_page_id' => "990335491009901", 'pusher_app_id' => null, 'pusher_app_key' => null, 'pusher_secret' => null, 'pusher_cluster' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pusher', 'description' => 'Leader In Realtime Technologies', 'status' => 1, 'tawk_property_id' => null, 'tawk_widget_id' => null, 'google_recaptcha_key' => null, 'google_recaptcha_secret' => null, 'google_analytics_id' => null, 'fb_page_id' => null, 'pusher_app_id' => '1603962', 'pusher_app_key' => '82f665b55640a9884640', 'pusher_secret' => 'abed4c5f6509621b07f0', 'pusher_cluster' => 'ap2', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
