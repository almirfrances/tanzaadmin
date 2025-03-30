<?php

namespace App\Providers;

use Mailjet\Client;
use App\Models\AdminModule;
use App\Mail\MailjetTransport;
use App\Providers\EmailService;
use Illuminate\Mail\MailManager;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\ForceHttpsMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register services here if needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Skip database operations if .env is not configured
        if (!$this->isDatabaseConfigured()) {
            Log::warning('Database configuration is incomplete. Skipping database checks.');
            return;
        }

        try {
            // Check database connection and settings module
            DB::connection()->getPdo(); // Actively check connection

            if (AdminModule::where('name', 'Settings')->where('status', 1)->exists()) {
                $this->loadAndShareSettings();
            }

            // Additional module checks
            $this->handleEmailService();
            $this->handleHttpsEnforcement();
            
        } catch (\Exception $e) {
            Log::error('Database connection failed: ' . $e->getMessage());
        }

        // Register Blade directives
        $this->registerBladeDirectives();
    }

    /**
     * Check if database environment variables are configured
     */
    protected function isDatabaseConfigured(): bool
    {
        return !empty(env('DB_DATABASE')) &&
               !empty(env('DB_USERNAME')) &&
               !empty(env('DB_PASSWORD'));
    }

    /**
     * Load and share settings with views
     */
    protected function loadAndShareSettings(): void
    {
        try {
            $settings = Setting::pluck('value', 'key')->toArray();
            View::share('settings', $settings);
        } catch (\Exception $e) {
            Log::error('Failed to load settings', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Handle email service registration
     */
    protected function handleEmailService(): void
    {
        if (AdminModule::isModuleEnabled('Email')) {
            $this->app->singleton(EmailService::class, fn () => new EmailService());
        }
    }

    /**
     * Handle HTTPS enforcement
     */
    protected function handleHttpsEnforcement(): void
    {
        if (AdminModule::isModuleEnabled('Settings') && Setting::where('key', 'force_https')->value('value')) {
            Route::pushMiddlewareToGroup('web', ForceHttpsMiddleware::class);
        }
    }

    /**
     * Register Blade directives
     */
    protected function registerBladeDirectives(): void
    {
        Blade::directive('isModule', function ($moduleName) {
            return "<?php if (\\App\\Models\\AdminModule::isModuleEnabled($moduleName)): ?>";
        });

        Blade::directive('endisModule', function () {
            return "<?php endif; ?>";
        });
    }
}