<?php

namespace Modules\Email\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Email\Database\Seeders\EmailSettingSeeder;
use Modules\Email\Database\Seeders\GlobalTemplateSeeder;
use Modules\Email\Database\Seeders\NotificationTemplateSeeder;

class EmailDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(NotificationTemplateSeeder::class);
        $this->call(EmailSettingSeeder::class);
        $this->call(GlobalTemplateSeeder::class);
    }
}
