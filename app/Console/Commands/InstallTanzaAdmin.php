<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallTanzaAdmin extends Command
{
    protected $signature = 'tanzaadmin:install';
    protected $description = 'Install and set up TanzaAdmin';

    public function handle()
    {
        $this->info('Starting TanzaAdmin installation...');

        // Run composer install to ensure vendor is installed
        $this->info('Installing Composer dependencies...');
        $composerInstall = shell_exec('composer install');
        if (!$composerInstall) {
            $this->error('Failed to install Composer dependencies.');
            return;
        }
        $this->info('Composer dependencies installed successfully.');

        // Ask for database details
        $dbHost = $this->ask('Enter Database Host', '127.0.0.1');
        $dbName = $this->ask('Enter Database Name', 'tanzaadmin');
        $dbUser = $this->ask('Enter Database Username', 'root');
        $dbPass = $this->secret('Enter Database Password (leave blank for none)');

        // Update .env file
        $envPath = base_path('.env');
        if (!File::exists($envPath)) {
            File::copy(base_path('.env.example'), $envPath);
        }

        $envContent = File::get($envPath);
        $envContent = preg_replace("/DB_HOST=.*/", "DB_HOST={$dbHost}", $envContent);
        $envContent = preg_replace("/DB_DATABASE=.*/", "DB_DATABASE={$dbName}", $envContent);
        $envContent = preg_replace("/DB_USERNAME=.*/", "DB_USERNAME={$dbUser}", $envContent);
        $envContent = preg_replace("/DB_PASSWORD=.*/", "DB_PASSWORD={$dbPass}", $envContent);
        File::put($envPath, $envContent);

        // Clear config cache to apply new DB settings
        Artisan::call('config:clear');

        // Import database.sql dump
        $sqlFile = public_path('database.sql');
        if (File::exists($sqlFile)) {
            $this->info('Importing database...');
            $command = "mysql -h {$dbHost} -u {$dbUser} " . ($dbPass ? "-p{$dbPass} " : "") . "{$dbName} < {$sqlFile}";
            system($command);
            $this->info('Database imported successfully.');
        } else {
            $this->warn('No database.sql file found. Skipping import.');
        }

        // Generate application key
        Artisan::call('key:generate');

        // Finalize setup
        Artisan::call('storage:link');
        Artisan::call('cache:clear');

        // Print admin credentials
        $this->info("\nTanzaAdmin installed successfully! 🎉");
        $this->info("Admin URL: " . url('/admin'));
        $this->info("Username: admin");
        $this->info("Password: tanzaadmin");
    }
}
