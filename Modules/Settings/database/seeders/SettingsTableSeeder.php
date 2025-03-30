<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'TanzaAdmin'],
            ['key' => 'site_email', 'value' => 'admin@tanzaadmin.com'],
            ['key' => 'site_phone', 'value' => '+255742552286'],
            ['key' => 'timezone', 'value' => 'UTC'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com'],
            ['key' => 'telegram_url', 'value' => 'https://telegram.org'],
            ['key' => 'pinterest_url', 'value' => 'https://pinterest.com'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com'],
            ['key' => 'github_url', 'value' => 'https://github.com'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
