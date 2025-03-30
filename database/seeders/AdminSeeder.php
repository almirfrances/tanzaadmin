<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'phone' => '1234567890',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Default password
            'status' => true,
        ]);
    }
}
