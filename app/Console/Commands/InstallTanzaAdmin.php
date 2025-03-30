<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class InstallTanzaAdmin extends Command
{
    protected $signature = 'tanzaadmin:install';
    protected $description = 'Install and set up TanzaAdmin';

    public function handle()
    {
        // Check if already installed
        if ($this->alreadyInstalled()) {
            $this->info('TanzaAdmin is already installed!');
            return;
        }

        $this->info('Starting TanzaAdmin installation...');
        $this->install();
    }

    protected function alreadyInstalled(): bool
    {
        return File::exists(base_path('.env')) && 
               Config::get('app.key') && 
               !empty(env('DB_DATABASE'));
    }

    protected function install()
    {
        // Get database credentials
        $dbHost = $this->ask('Database Host', '127.0.0.1');
        $dbName = $this->ask('Database Name', 'tanzaadmin');
        $dbUser = $this->ask('Database Username', 'root');
        $dbPass = $this->secret('Database Password (blank for none)');

        // Create .env file
        $this->createEnvFile($dbHost, $dbName, $dbUser, $dbPass);

        // Wait for config update
        sleep(2); // Allow time for config cache clear
        Artisan::call('config:clear');

        // Import database
        $this->importDatabase($dbHost, $dbUser, $dbPass, $dbName);

        // Finalize setup
        Artisan::call('key:generate --force');
        Artisan::call('storage:link');
        Artisan::call('cache:clear');

        $this->showSuccessMessage();
    }

    protected function createEnvFile($host, $name, $user, $pass)
    {
        if (!File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
        }

        $env = File::get(base_path('.env'));
        $env = preg_replace([
            '/DB_HOST=.*/',
            '/DB_DATABASE=.*/',
            '/DB_USERNAME=.*/',
            '/DB_PASSWORD=.*/'
        ], [
            "DB_HOST=$host",
            "DB_DATABASE=$name",
            "DB_USERNAME=$user",
            "DB_PASSWORD=$pass"
        ], $env);

        File::put(base_path('.env'), $env);
    }

    protected function importDatabase($host, $user, $pass, $name)
    {
        $sqlFile = public_path('tanzaadmin.sql');
        if (File::exists($sqlFile)) {
            $this->info('Importing database...');
            $command = sprintf(
                'mysql -h %s -u %s %s %s < %s',
                escapeshellarg($host),
                escapeshellarg($user),
                $pass ? '-p'.escapeshellarg($pass) : '',
                escapeshellarg($name),
                escapeshellarg($sqlFile)
            );
            exec($command, $output, $status);
            
            if ($status !== 0) {
                $this->error('Database import failed!');
                exit(1);
            }
        }
    }

    protected function showSuccessMessage()
    {
        $this->info("\nTanzaAdmin installed successfully! 🎉");
        $this->info("Admin URL: ".url('/admin'));
        $this->info("Username: admin");
        $this->info("Password: tanzaadmin");
        $this->warn("\nPlease run these commands manually:");
        $this->line("composer install");
        $this->line("php artisan optimize:clear");
    }
}