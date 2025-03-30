<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class InstallTanzaAdmin extends Command
{
    protected $signature = 'tanzaadmin:install';
    protected $description = 'Install TanzaAdmin with proper dependency handling';

    public function handle()
    {
        if ($this->alreadyInstalled()) {
            $this->info('TanzaAdmin is already installed!');
            return;
        }

        $this->setupEnvironment();
        $this->installDependencies();
        $this->finalizeInstallation();
    }

    protected function alreadyInstalled(): bool
    {
        return File::exists(base_path('.env')) && 
               Config::get('app.key') && 
               !empty(env('DB_DATABASE'));
    }

    protected function setupEnvironment()
    {
        // Get database credentials
        $dbHost = $this->ask('Database Host', '127.0.0.1');
        $dbName = $this->ask('Database Name', 'tanzaadmin');
        $dbUser = $this->ask('Database Username', 'root');
        $dbPass = $this->secret('Database Password (blank for none)');

        // Create .env file
        $this->createEnvFile([
            'DB_HOST' => $dbHost,
            'DB_DATABASE' => $dbName,
            'DB_USERNAME' => $dbUser,
            'DB_PASSWORD' => $dbPass
        ]);

        // Clear configuration cache
        Artisan::call('config:clear');
        sleep(2); // Allow time for env refresh
    }

    protected function createEnvFile(array $variables)
    {
        $envExample = File::get(base_path('.env.example'));
        foreach ($variables as $key => $value) {
            $envExample = preg_replace(
                "/^{$key}=.*/m",
                "{$key}={$value}",
                $envExample
            );
        }
        File::put(base_path('.env'), $envExample);
    }

    protected function installDependencies()
    {
        $this->info('Installing Composer dependencies...');
        
        // Install without triggering scripts
        $this->runShellCommand('composer install --no-interaction --no-scripts');
        
        $this->info('Updating Composer dependencies...');
        $this->runShellCommand('composer update --no-interaction --no-scripts');
        
        // Manually run critical post-install commands
        $this->info('Running package discovery...');
        Artisan::call('package:discover');
    }

    protected function runShellCommand(string $command)
    {
        $output = null;
        $status = null;
        exec($command, $output, $status);
        
        if ($status !== 0) {
            $this->error('Command failed: ' . $command);
            $this->line(implode("\n", $output));
            exit(1);
        }
    }

    protected function finalizeInstallation()
    {
        $this->importDatabase();
        Artisan::call('key:generate --force');
        Artisan::call('storage:link');
        Artisan::call('optimize:clear');

        $this->info("\nTanzaAdmin installed successfully! 🎉");
        $this->info("Admin URL: " . url('/admin'));
        $this->info("Username: admin");
        $this->info("Password: tanzaadmin");
    }

    protected function importDatabase()
    {
        $sqlFile = public_path('tanzaadmin.sql');
        if (File::exists($sqlFile)) {
            $this->info('Importing database...');
            $this->runShellCommand(sprintf(
                'mysql -h %s -u %s %s %s < %s',
                escapeshellarg(env('DB_HOST')),
                escapeshellarg(env('DB_USERNAME')),
                env('DB_PASSWORD') ? '-p' . escapeshellarg(env('DB_PASSWORD')) : '',
                escapeshellarg(env('DB_DATABASE')),
                escapeshellarg($sqlFile)
            ));
        }
    }
}