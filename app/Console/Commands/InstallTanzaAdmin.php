<?php

namespace App\Console\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class InstallTanzaAdmin extends Command
{
    protected $signature = 'tanzaadmin:install';
    protected $description = 'Install TanzaAdmin with proper configuration flow';

    public function handle()
    {
        $this->showHeader();
        $this->setupEnvironment();
        $this->installDependencies();
        $this->configureDatabase();
        $this->finalizeInstallation();
    }

    protected function showHeader()
    {
        $this->info("
    ████████╗  █████╗  ███╗  ██╗ ███████╗  █████╗   █████╗  ██████╗ ███╗   ███╗██╗███╗   ██╗
    ╚══██╔══╝ ██╔══██╗ ████╗ ██║ ╚══███╔╝ ██╔══██╗ ██╔══██╗██╔════╝ ████╗ ████║██║████╗  ██║
       ██║    ███████║ ██╔██╗██║   ███╔╝  ███████║ ██║  ██║██║  ███╗██╔████╔██║██║██╔██╗ ██║
       ██║    ██╔══██║ ██║╚██╗██║  ███╔╝   ██╔══██║ ██║  ██║██║   ██║██║╚██╔╝██║██║██║╚██╗██║
       ██║    ██║  ██║ ██║ ╚████║ ███████╗ ██║  ██║ ╚█████╔╝╚██████╔╝██║ ╚═╝ ██║██║██║ ╚████║
       ╚═╝    ╚═╝  ╚═╝ ╚═╝  ╚═══╝ ╚══════╝ ╚═╝  ╚═╝  ╚════╝  ╚═════╝ ╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝
");
    }

    protected function setupEnvironment()
    {
        $this->info("\n🛠  Environment Setup");
    
        // Create fresh .env from example
        if (!File::exists(base_path('.env'))) {
            File::copy(base_path('.env.example'), base_path('.env'));
        }
    
        $this->updateEnvVariables([
            'APP_NAME' => $this->ask('Application Name', 'TanzaAdmin'),
            'APP_URL' => $this->ask('Application URL', 'http://localhost:8000'),
            'DB_HOST' => $this->ask('Database Host', '127.0.0.1'),
            'DB_PORT' => $this->ask('Database Port', '3306'),
            'DB_DATABASE' => $this->ask('Database Name', 'tanzaadmin'),
            'DB_USERNAME' => $this->ask('Database User', 'root'),
            'DB_PASSWORD' => $this->secret('Database Password'),
        ]);
    
        // Reload environment properly
        $this->reloadEnvironment();
    }

    protected function reloadEnvironment()
    {
        Artisan::call('config:clear');
        
        // Clear loaded environment
        (new \Dotenv\Dotenv(
            \Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
                ->addAdapter(\Dotenv\Repository\Adapter\EnvConstAdapter::class)
                ->addWriter(\Dotenv\Repository\Adapter\PutenvAdapter::class)
                ->immutable()
                ->make()
        ))->load(base_path('.env'));
    
        // Verify using getenv() instead of env()
        $this->info("\n🔍 Verifying environment variables:");
        $this->table(
            ['Key', 'Value'],
            [
                ['DB_HOST', getenv('DB_HOST')],
                ['DB_PORT', getenv('DB_PORT')],
                ['DB_DATABASE', getenv('DB_DATABASE')],
                ['DB_USERNAME', getenv('DB_USERNAME')],
                ['DB_PASSWORD', str_repeat('*', strlen(getenv('DB_PASSWORD') ?? ''))],
            ]
        );
    
        if (empty(getenv('DB_USERNAME')) || empty(getenv('DB_DATABASE'))) {
            $this->error('❌ Database configuration is incomplete!');
            exit(1);
        }
    }

    protected function updateEnvVariables(array $variables)
    {
        $envPath = base_path('.env');
        $envContent = File::exists($envPath) ? File::get($envPath) : File::get(base_path('.env.example'));
    
        foreach ($variables as $key => $value) {
            $value = $this->formatEnvValue($value);
            $pattern = "/^{$key}=.*/m";
            
            if (preg_match($pattern, $envContent)) {
                // Replace existing value
                $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
            } else {
                // Append new value
                $envContent .= "\n{$key}={$value}";
            }
        }
    
        File::put($envPath, $envContent);
        $this->info('✅ Environment variables updated');
    }
    
    protected function formatEnvValue($value)
    {
        if ($value === null || $value === '') {
            return '';
        }
        if (preg_match('/\s|#/', $value)) {
            return '"'.trim($value).'"';
        }
        return $value;
    }


    protected function installDependencies()
    {
        $this->info("\n📦 Installing Dependencies");
        $this->executeCommand('composer install --no-interaction --no-scripts');
        $this->executeCommand('composer update --no-interaction --no-scripts');
        Artisan::call('package:discover');
    }

    protected function configureDatabase()
    {
        $this->info("\n🔐 Database Configuration");
        
        try {
            DB::connection()->getPdo();
            $this->info('✅ Database connection verified');
        } catch (\Exception $e) {
            $this->error('❌ Database connection failed: ' . $e->getMessage());
            exit(1);
        }

        $this->handleDatabaseSetup();
    }

    protected function handleDatabaseSetup()
    {
        $choice = $this->choice('Database setup method:', [
            'Import SQL dump',
            'Run migrations',
            'Skip for now'
        ], 0);

        switch ($choice) {
            case 'Import SQL dump':
                $this->importSqlDump();
                break;
            case 'Run migrations':
                $this->runMigrations();
                break;
            default:
                $this->warn('⚠️ Database setup skipped');
        }
    }

    protected function importSqlDump()
    {
        $sqlFile = public_path('tanzaadmin.sql');
        
        if (!File::exists($sqlFile)) {
            $this->error('❌ tanzaadmin.sql file not found!');
            return;
        }

        $this->executeCommand(sprintf(
            'mysql -h %s -u %s %s %s < %s',
            escapeshellarg(env('DB_HOST')),
            escapeshellarg(env('DB_USERNAME')),
            env('DB_PASSWORD') ? '-p' . escapeshellarg(env('DB_PASSWORD')) : '',
            escapeshellarg(env('DB_DATABASE')),
            escapeshellarg($sqlFile)
        ));

        $this->info('✅ Database imported successfully');
    }

    protected function runMigrations()
    {
        try {
            Artisan::call('migrate --force');
            $this->info('✅ Database migrations completed');
        } catch (\Exception $e) {
            $this->error('❌ Migration failed: ' . $e->getMessage());
        }
    }

    protected function finalizeInstallation()
    {
        $this->info("\n🎉 Finalizing Installation");
        
        Artisan::call('key:generate --force');
        Artisan::call('storage:link');
        Artisan::call('optimize:clear');

        $this->showSuccessMessage();
    }

    protected function showSuccessMessage()
    {
        $this->info("\n🚀 Installation Complete!");
        $this->line("Admin URL: " . url('/admin'));
        $this->line("Username: admin");
        $this->line("Password: tanzaadmin");
        $this->line("\n👉 Next steps:");
        $this->line("1. php artisan serve");
        $this->line("2. npm install && npm run dev");
    }

    protected function executeCommand($command)
    {
        $output = [];
        $status = null;
        
        exec($command, $output, $status);
        
        if ($status !== 0) {
            $this->error('❌ Command failed: ' . $command);
            $this->line(implode("\n", $output));
            exit(1);
        }
    }

    
}