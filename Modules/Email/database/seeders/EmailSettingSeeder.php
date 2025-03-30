<?php

namespace Modules\Email\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Email\Models\EmailSetting;

class EmailSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Create default email settings
        EmailSetting::firstOrCreate(
            ['provider' => 'smtp'], // Check if this exists
            [
                'settings' => [
                    'email' => 'admin@example.com',
                    'host' => 'smtp.example.com',
                    'port' => 587,
                    'encryption' => 'tls',
                    'username' => 'admin@example.com',
                    'password' => 'password123',
                ],
            ]
        );
    }
}
