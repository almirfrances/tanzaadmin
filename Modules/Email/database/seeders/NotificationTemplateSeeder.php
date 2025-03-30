<?php

namespace Modules\Email\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Email\Models\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        NotificationTemplate::insert([
            [
                'name' => 'User Registration',
                'subject' => 'Welcome to {{site_name}}!',
                'body' => 'Hello {{name}}, thank you for registering at {{site_name}}.',
                'slug' => Str::slug('User Registration'),
                'status' => true,
            ],
            [
                'name' => 'Password Reset',
                'subject' => 'Password Reset Request',
                'body' => 'Hello {{name}}, use the following link to reset your password:',
                'slug' => Str::slug('Password Reset'),
                'status' => true,
            ],
        ]);
    }
}
