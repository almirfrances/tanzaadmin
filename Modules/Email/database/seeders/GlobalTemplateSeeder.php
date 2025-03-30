<?php

namespace Modules\Email\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Email\Models\GlobalTemplate;

class GlobalTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        GlobalTemplate::firstOrCreate(
            ['name' => 'Global Email Template'],
            [
                'subject' => 'Your Notification from {{site_name}}',
                'html_template' => '<html>
                    <body>
                        <h1>Hello {{name}},</h1>
                        <p>{{message}}</p>
                        <p>Regards,</p>
                        <p>{{site_name}}</p>
                    </body>
                </html>',
            ]
        );

        $this->command->info('Global Email Template seeded successfully.');
    }
}
