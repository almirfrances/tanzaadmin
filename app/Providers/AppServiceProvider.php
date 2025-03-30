<?php

namespace App\Providers;

use Mailjet\Client;
use App\Models\AdminModule;
use App\Mail\MailjetTransport;
use App\Providers\EmailService;
use Illuminate\Mail\MailManager;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\View;
use Modules\Settings\Models\Setting;
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
        // Avoiding DB connection check if database is not yet configured
        try {
            // Check if the Settings module is active and ensure the database is connected
            if (DB::connection()->getDatabaseName()) {
                $settingsModule = AdminModule::where('name', 'Settings')->where('status', 1)->exists();

                if ($settingsModule) {
                    try {
                        // Load settings from the database
                        $this->settings = Setting::pluck('value', 'key')->toArray();

                        // Share settings with all views
                        View::share('settings', $this->settings);
                    } catch (\Exception $e) {
                        \Log::error('Failed to load settings', ['error' => $e->getMessage()]);
                    }
                }
            }
        } catch (\Exception $e) {
            // Log an error if the database connection is not configured yet
            \Log::warning('Database connection not configured or failed: ' . $e->getMessage());
        }

        // Check if the Email module is active and bind EmailService
        if (AdminModule::isModuleEnabled('Email')) {
            $this->app->singleton(EmailService::class, function ($app) {
                return new EmailService();
            });
        }

        // Enforce HTTPS if the Settings module is active and force_https is enabled
        if (AdminModule::isModuleEnabled('Settings')) {
            $forceHttps = Setting::where('key', 'force_https')->value('value');

            if ($forceHttps) {
                Route::middlewareGroup('web', [
                    ForceHttpsMiddleware::class,
                ]);
            }
        }

        // Register Blade directive for checking module availability and status
        Blade::directive('isModule', function ($moduleName) {
            return "<?php if (\\App\\Models\\AdminModule::isModuleEnabled($moduleName)): ?>";
        });

        Blade::directive('endisModule', function () {
            return "<?php endif; ?>";
        });
    }
}
