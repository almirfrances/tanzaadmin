<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Database\Seeders\SocialLoginsTableSeeder;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(SocialLoginsTableSeeder::class);
    }
}
