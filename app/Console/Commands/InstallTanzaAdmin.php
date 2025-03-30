<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InstallTanzaAdmin extends Command
{
    protected $signature = 'tanzaadmin:install';
    protected $description = 'Install TanzaAdmin with proper database setup';

    public function handle()
    {
        $this->showWelcome();
        $this->createEnvFile();
        $this->installDependencies();
        $this->setupDatabase();
        $this->finalizeInstallation();
    }

    protected function showWelcome()
    {
        $this->info("
            ████████╗ █████╗ ███╗   ██╗███████╗ █████╗ 
            ╚══██╔══╝██╔══██╗████╗  ██║╚══███╔╝██╔══██╗
               ██║   ███████║██╔██╗ ██║  ███╔╝ ███████║
               ██║   ██╔══██║██║╚██╗██║ ███╔╝  ██╔══██║
               ██║   ██║  ██║██║ ╚████║███████╗██║  ██║
               ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝
        ");
    }

    protected function createEnvFile()
    {
        if (File::exists(base_path('.env'))) {
            if (!$this->confirm('.env file already exists. Overwrite?')) {
                return;
            }
        }

        $this->info("\n<< Database Configuration >>");
        $dbConfig = [
            'DB_HOST' => $this->ask('Host', '127.0.0.1'),
            'DB_PORT' => $this->ask('Port', '3306'),
            'DB_DATABASE' => $this->ask('Database Name', 'tanzaadmin'),
            'DB_USERNAME' => $this->ask('Username', 'root'),
            'DB_PASSWORD' => $this->secret('Password (leave empty if none)'),
        ];

        $envContent = File::get(base_path('.env.example'));
        foreach ($dbConfig as $key => $value) {
            $envContent = preg_replace(
                "/^{$key}=.*/m",
                "{$key}=" . (empty($value) ? 'null' : '"'.$value.'"'),
                $envContent
            );
        }

        File::put(base_path('.env'), $envContent);
        $this->info('.env file created successfully!');
    }

    protected function installDependencies()
    {
        $this->info("\n<< Installing Dependencies >>");
        $this->runShellCommand('composer install --no-interaction --no-scripts');
        $this->runShellCommand('composer update --no-interaction --no-scripts');
        Artisan::call('package:discover');
    }

    protected function setupDatabase()
    {
        $this->info("\n<< Database Setup >>");
        
        // Verify database connection
        try {
            DB::connection()->getPdo();
            $this->info("✓ Connected to database successfully");
        } catch (\Exception $e) {
            $this->error("✗ Database connection failed: " . $e->getMessage());
            exit(1);
        }

        // Import SQL dump or run migrations
        $sqlFile = public_path('tanzaadmin.sql');
        if (File::exists($sqlFile)) {
            $this->importDatabaseDump($sqlFile);
            $this->info("✓ Database imported from tanzaadmin.sql");
        } else {
            $this->runMigrations();
        }
    }

    protected function importDatabaseDump($sqlFile)
    {
        $db = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $command = sprintf(
            'mysql -h %s -u %s %s %s < %s',
            escapeshellarg($host),
            escapeshellarg($user),
            $pass ? '-p' . escapeshellarg($pass) : '',
            escapeshellarg($db),
            escapeshellarg($sqlFile)
        );

        $this->runShellCommand($command);
    }

    protected function runShellCommand($command)
    {
        $output = null;
        $status = null;
        exec($command, $output, $status);
        
        if ($status !== 0) {
            $this->error("Command failed: {$command}");
            $this->line(implode("\n", $output));
            exit(1);
        }
    }

    protected function finalizeInstallation()
    {
        $this->info("\n<< Finalizing Installation >>");
        Artisan::call('key:generate --force');
        Artisan::call('storage:link');
        Artisan::call('optimize:clear');

        $this->info("\n✅ Installation Complete!");
        $this->line("Admin URL: " . url('/admin'));
        $this->line("Username: admin");
        $this->line("Password: tanzaadmin");
        $this->line("\nRun these commands to start:");
        $this->line("php artisan serve");
        $this->line("npm install && npm run dev");
    }
}