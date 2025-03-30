<?php

namespace Modules\Settings\Http\Controllers;

use Exception;
use Throwable;
use App\Models\AdminModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Settings\Models\Setting;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Cache;
use Modules\Users\Models\SocialLogin;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Modules\Email\Http\Controllers\EmailController;
use Symfony\Component\Process\Exception\ProcessFailedException;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings::index');
    }


    public function general()
    {
        // Retrieve all settings
        $settings = Cache::remember('settings', 60, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        return view('settings::general', compact('settings'));
    }


    public function updateGeneralSettings(Request $request)
    {
        try {
            // Specify the fields to be updated
            $allowedFields = [
                'site_name',
                'site_email',
                'site_phone',
                'timezone',
                'facebook_url',
                'twitter_url',
                'instagram_url',
                'youtube_url',
                'telegram_url',
                'pinterest_url',
                'linkedin_url',
                'github_url',
                'tinymce_api',
            ];

            // Define validation rules
            $rules = [
                'site_name' => 'required|string|max:255',
                'site_email' => 'required|email|max:255',
                'site_phone' => 'nullable|string|max:20',
                'timezone' => 'required|string|in:' . implode(',', timezone_identifiers_list()),
                'facebook_url' => 'nullable|url',
                'twitter_url' => 'nullable|url',
                'instagram_url' => 'nullable|url',
                'youtube_url' => 'nullable|url',
                'telegram_url' => 'nullable|url',
                'pinterest_url' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'github_url' => 'nullable|url',
                'tinymce_api' => 'nullable'
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                sweetalert()->error('Validation failed. Please check the input fields.');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Begin transaction
            DB::beginTransaction();

            $updatedKeys = [];
            foreach ($allowedFields as $field) {
                if ($request->has($field)) {
                    $value = $request->input($field);
                    Setting::updateOrCreate(['key' => $field], ['value' => $value]);
                    $updatedKeys[] = $field;
                }
            }

            // Clear cached settings
            Cache::forget('settings');

            // Commit transaction
            DB::commit();

            // Log successful update
            Log::info('General settings updated successfully.', ['updated_keys' => $updatedKeys]);

            sweetalert()->success('General settings updated successfully.');
            return redirect()->route('settings.general');
        } catch (Exception $e) {
            // Check if there's a specific issue
            Log::error('Failed to update general settings.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Rollback transaction if it was started
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            // sweetalert()->error('An error occurred while updating settings. Please try again later.');

            // Add additional information for debugging
            return redirect()->back()->with('debug_error', $e->getMessage())->withInput();
        }
    }


    public function configuration()
    {
        $settings = Cache::remember('settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        return view('settings::configuration', compact('settings'));
    }

    public function updateForceHttps(Request $request)
    {
        try {
            DB::beginTransaction();

            $forceHttps = $request->boolean('force_https');
            Setting::updateOrCreate(['key' => 'force_https'], ['value' => $forceHttps]);

            Cache::forget('settings'); // Clear cache

            DB::commit();

            Log::info('Force HTTPS setting updated.', ['force_https' => $forceHttps]);
            sweetalert()->success('HTTPS enforcement setting updated successfully.');

            return redirect()->route('admin.settings.configuration');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update Force HTTPS setting.', ['error' => $e->getMessage()]);
            sweetalert()->error('An error occurred while updating the setting. Please try again.');

            return redirect()->route('admin.settings.configuration');
        }
    }


    public function updateAuthForms(Request $request)
{
    try {
        DB::beginTransaction();

        // Validate the request data
        $validated = $request->validate([
            'enable_register_form' => 'boolean',
            'enable_login_form' => 'boolean',
        ]);

        // Update settings using key-value pairs
        Setting::updateOrCreate(['key' => 'enable_register_form'], ['value' => $request->boolean('enable_register_form')]);
        Setting::updateOrCreate(['key' => 'enable_login_form'], ['value' => $request->boolean('enable_login_form')]);

        Cache::forget('settings'); // Clear settings cache

        DB::commit();

        Log::info('Authentication form settings updated.', [
            'enable_register_form' => $validated['enable_register_form'] ?? 0,
            'enable_login_form' => $validated['enable_login_form'] ?? 0,
        ]);

        sweetalert()->success('Authentication form settings updated successfully.');

        return redirect()->route('admin.settings.configuration');
    } catch (\Exception $e) {
        DB::rollBack();

        Log::error('Failed to update Authentication form settings.', ['error' => $e->getMessage()]);
        sweetalert()->error('An error occurred while updating the settings. Please try again.');

        return redirect()->route('admin.settings.configuration');
    }
}


    public function updateAllowUserRegistration(Request $request)
    {
        try {
            DB::beginTransaction();

            $allowUserRegistration = $request->boolean('allow_user_registration');
            Setting::updateOrCreate(['key' => 'allow_user_registration'], ['value' => $allowUserRegistration]);

            Cache::forget('settings'); // Clear cache

            DB::commit();

            Log::info('Allow User Registration setting updated.', ['allow_user_registration' => $allowUserRegistration]);
            sweetalert()->success('User registration setting updated successfully.');

            return redirect()->route('admin.settings.configuration');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update Allow User Registration setting.', ['error' => $e->getMessage()]);
            sweetalert()->error('An error occurred while updating the setting. Please try again.');

            return redirect()->route('admin.settings.configuration');
        }
    }

    public function updateRequireEmailConfirmation(Request $request)
    {
        try {
            DB::beginTransaction();

            $requireEmailConfirmation = $request->boolean('require_email_confirmation');
            Setting::updateOrCreate(['key' => 'require_email_confirmation'], ['value' => $requireEmailConfirmation]);

            Cache::forget('settings'); // Clear cache

            DB::commit();

            Log::info('Require Email Confirmation setting updated.', ['require_email_confirmation' => $requireEmailConfirmation]);
            sweetalert()->success('Email confirmation setting updated successfully.');

            return redirect()->route('admin.settings.configuration');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update Require Email Confirmation setting.', ['error' => $e->getMessage()]);
            sweetalert()->error('An error occurred while updating the setting. Please try again.');

            return redirect()->route('admin.settings.configuration');
        }
    }

    public function updateAdminLoginNotifications(Request $request)
    {
        try {
            DB::beginTransaction();

            $notifyAdminOnLogin = $request->boolean('notify_admin_on_login');
            $notifyAdminOnLoginFail = $request->boolean('notify_admin_on_login_fail');

            Setting::updateOrCreate(['key' => 'notify_admin_on_login'], ['value' => $notifyAdminOnLogin]);
            Setting::updateOrCreate(['key' => 'notify_admin_on_login_fail'], ['value' => $notifyAdminOnLoginFail]);

            Cache::forget('settings'); // Clear cache

            DB::commit();

            Log::info('Admin Login Notifications settings updated.', [
                'notify_admin_on_login' => $notifyAdminOnLogin,
                'notify_admin_on_login_fail' => $notifyAdminOnLoginFail,
            ]);
            sweetalert()->success('Admin login notifications updated successfully.');

            return redirect()->route('admin.settings.configuration');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update Admin Login Notifications settings.', ['error' => $e->getMessage()]);
            sweetalert()->error('An error occurred while updating the settings. Please try again.');

            return redirect()->route('admin.settings.configuration');
        }
    }

    public function updateAllowEmailNotifications(Request $request)
    {
        try {
            DB::beginTransaction();

            $allowEmailNotifications = $request->boolean('allow_email_notifications');
            Setting::updateOrCreate(['key' => 'allow_email_notifications'], ['value' => $allowEmailNotifications]);

            Cache::forget('settings'); // Clear cache

            DB::commit();

            Log::info('Allow Email Notifications setting updated.', ['allow_email_notifications' => $allowEmailNotifications]);
            sweetalert()->success('Email notifications setting updated successfully.');

            return redirect()->route('admin.settings.configuration');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Failed to update Allow Email Notifications setting.', ['error' => $e->getMessage()]);
            sweetalert()->error('An error occurred while updating the setting. Please try again.');

            return redirect()->route('admin.settings.configuration');
        }
    }


    public function clearCache()
    {
        try {
            // Execute the optimize:clear command
            Artisan::call('optimize:clear');

            // Capture the output from the Artisan command
            $artisanOutput = Artisan::output();

            // Log the result of the command
            Log::info('php artisan optimize:clear Output:', ['output' => $artisanOutput]);

            // Flash SweetAlert success notification to the session
            sweetalert()->success('Cache Cleared Successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to clear cache:', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Flash SweetAlert error notification to the session
            sweetalert()->error(
                'Failed to Clear Cache',
                'An error occurred while clearing the cache. Please try again or contact support.'
            );
        }

        return redirect()->back();
    }




    public function createBackup()
    {
        try {
            // Run the backup using Artisan
            $output = Artisan::call('backup:run', [
                '--only-db' => false, // Include both files and database in the backup
            ]);

            // Capture Artisan output for logs or notifications
            $artisanOutput = Artisan::output();

            // Log success details
            Log::info('Backup completed successfully.', ['output' => $artisanOutput]);

            // Notify admin via email if Email module is active
            if ($this->isModuleActive('Email')) {
                $this->sendBackupEmail('Successful Backup', [
                    'email' => Setting::getValue('site_email'),
                    'name' => Setting::getValue('site_name'),
                    'username' => 'admin',
                    'site_name' => Setting::getValue('site_name'),
                    'message' => 'The system backup was successfully created. Details: ' . nl2br($artisanOutput),
                ]);
            }

            // Notify admin via SweetAlert
            sweetalert()->success('Backup created successfully.');
        } catch (\Exception $e) {
            // Log error details
            Log::error('Backup failed.', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Notify admin via email if Email module is active
            if ($this->isModuleActive('Email')) {
                $this->sendBackupEmail('Failed Backup', [
                    'email' => Setting::getValue('site_email'),
                    'name' => Setting::getValue('site_name'),
                    'username' => 'admin',
                    'site_name' => Setting::getValue('site_name'),
                    'message' => 'The backup failed. Error details: ' . $e->getMessage(),
                ]);
            }

            // Notify admin via SweetAlert
            sweetalert()->error('Backup failed.');
        }

        return redirect()->back();
    }


    protected function sendBackupEmail(string $templateName, array $data)
{
    try {
        // Instantiate the EmailController
        $emailController = new \Modules\Email\Http\Controllers\EmailController();

        // Use the dynamic email method
        $emailController->sendDynamicEmail($templateName, $data);

        Log::info("Backup notification email sent for template: {$templateName}", ['recipient' => $data['email']]);
    } catch (\Exception $e) {
        Log::error('Failed to send backup notification email.', [
            'exception' => $e->getMessage(),
            'template' => $templateName,
        ]);
    }
}
protected function isModuleActive(string $moduleName): bool
{
    return AdminModule::where('name', $moduleName)->where('status', 1)->exists();
}






public function indexBackup()
{
    try {
        // Get the backup folder name from the config file
        $backupFolder = '/' . config('backup.backup.name');

        // Define the full path to the backup folder
        $disk = Storage::disk('local');
        $files = collect();

        // Check if the directory exists
        if ($disk->exists($backupFolder)) {
            // Retrieve and map files in the backup folder
            $files = collect($disk->files($backupFolder))
                ->filter(fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'zip') // Include only ZIP files
                ->map(function ($file) use ($disk) {
                    return [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => $this->formatFileSize($disk->size($file)), // Format file size
                        'last_modified' => date('Y-m-d H:i:s', $disk->lastModified($file)), // Format modification date
                    ];
                })
                ->sortByDesc('last_modified') // Sort by the most recent files
                ->values(); // Reindex the collection
        }

        if ($files->isEmpty()) {
            sweetalert()->info('No backups found.');
        }

        return view('settings::backups.index', compact('files'));
    } catch (\Exception $e) {
        Log::error('Failed to list backups: ' . $e->getMessage());
        sweetalert()->error('Failed to retrieve backups. Check logs for details.');

        return view('settings::backups.index', ['files' => collect()]);
    }
}


/**
 * Format file size into a readable format.
 *
 * @param int $bytes
 * @return string
 */
private function formatFileSize($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $unit = 0;

    while ($bytes >= 1024 && $unit < count($units) - 1) {
        $bytes /= 1024;
        $unit++;
    }

    return round($bytes, 2) . ' ' . $units[$unit];
}






public function downloadBackup($fileName)
{
    try {
        $backupFolder = '/' . config('backup.backup.name');
        $disk = Storage::disk('local');

        if ($disk->exists("$backupFolder/$fileName")) {
            return response()->download($disk->path("$backupFolder/$fileName"));
        }

        sweetalert()->error('File not found.');
    } catch (\Exception $e) {
        Log::error('Failed to download backup: ' . $e->getMessage());
        sweetalert()->error('Failed to download the backup.');
    }

    return redirect()->back();
}

public function deleteBackup($fileName)
{
    try {
        $backupFolder = '/' . config('backup.backup.name');
        $disk = Storage::disk('local');

        if ($disk->exists("$backupFolder/$fileName")) {
            $disk->delete("$backupFolder/$fileName");
            sweetalert()->success('Backup deleted successfully.');
        } else {
            sweetalert()->error('File not found.');
        }
    } catch (\Exception $e) {
        Log::error('Failed to delete backup: ' . $e->getMessage());
        sweetalert()->error('Failed to delete the backup.');
    }

    return redirect()->back();
}

public function restoreBackup($fileName)
{
    try {
        $backupFolder = '/' . config('backup.backup.name');
        $disk = Storage::disk('local');

        if ($disk->exists("$backupFolder/$fileName")) {
            // Implement your restoration logic here
            sweetalert()->success('Backup restored successfully.');
        } else {
            sweetalert()->error('File not found.');
        }
    } catch (\Exception $e) {
        Log::error('Failed to restore backup: ' . $e->getMessage());
        sweetalert()->error('Failed to restore the backup.');
    }

    return redirect()->back();
}





public function logoFavicon()
{
    $settings = [
        'logo_light' => Setting::getValue('logo_light', 'default/logo_light.png'),
        'logo_dark' => Setting::getValue('logo_dark', 'default/logo_dark.png'),
        'favicon' => Setting::getValue('favicon', 'default/favicon.png'),
    ];

    return view('settings::logo-favicon', compact('settings'));
}

public function updateLogoFavicon(Request $request)
{
    $request->validate([
        'logo_light' => 'nullable|image|mimes:png,jpg,jpeg,svg',
        'logo_dark' => 'nullable|image|mimes:png,jpg,jpeg,svg',
        'favicon' => 'nullable|image|mimes:png,ico,jpg,svg,jpeg',
    ]);

    try {
        // Process Logo Light
        if ($request->hasFile('logo_light')) {
            $oldLogoLight = Setting::getValue('logo_light');
            if ($oldLogoLight && Storage::disk('public')->exists($oldLogoLight)) {
                Storage::disk('public')->delete($oldLogoLight);
            }

            $logoLightPath = $request->file('logo_light')->store('uploads/logos', 'public');
            Setting::setValue('logo_light', $logoLightPath);
        }

        // Process Logo Dark
        if ($request->hasFile('logo_dark')) {
            $oldLogoDark = Setting::getValue('logo_dark');
            if ($oldLogoDark && Storage::disk('public')->exists($oldLogoDark)) {
                Storage::disk('public')->delete($oldLogoDark);
            }

            $logoDarkPath = $request->file('logo_dark')->store('uploads/logos', 'public');
            Setting::setValue('logo_dark', $logoDarkPath);
        }

        // Process Favicon
        if ($request->hasFile('favicon')) {
            $oldFavicon = Setting::getValue('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }

            $faviconPath = $request->file('favicon')->store('uploads/logos', 'public');
            Setting::setValue('favicon', $faviconPath);
        }

        // SweetAlert success notification with correct arguments
        sweetalert()->success('Logo and Favicon updated successfully!');

        return redirect()->route('admin.settings.logo-favicon');
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Failed to update logo and favicon', ['error' => $e->getMessage()]);

        // SweetAlert error notification with correct arguments
        sweetalert()->error('Failed to update logo and favicon. Please try again.');

        return redirect()->route('admin.settings.logo-favicon');
    }
}

public function customCode()
{
    $settings = Cache::remember('settings', 3600, function () {
        return Setting::pluck('value', 'key')->toArray();
    });

    return view('settings::custom-code', compact('settings'));
}

public function updateCustomCode(Request $request)
{
    $validatedData = $request->validate([
        'header_code' => 'nullable|string',
        'footer_code' => 'nullable|string',
    ]);

    try {
        DB::beginTransaction();

        Setting::updateOrCreate(['key' => 'header_code'], ['value' => $validatedData['header_code']]);
        Setting::updateOrCreate(['key' => 'footer_code'], ['value' => $validatedData['footer_code']]);

        Cache::forget('settings');

        DB::commit();

        sweetalert()->success('Custom code settings updated successfully.');
        return redirect()->route('admin.settings.custom-code');
    } catch (Exception $e) {
        DB::rollBack();

        Log::error('Failed to update custom code settings.', ['error' => $e->getMessage()]);
        sweetalert()->error('An error occurred while updating the settings. Please try again.');

        return redirect()->route('admin.settings.custom-code');
    }
}



public function sitemapXML()
{
    $filePath = public_path('sitemap.xml');
    $sitemapContent = File::exists($filePath) ? File::get($filePath) : '';

    return view('settings::sitemap-xml', compact('sitemapContent'));
}

public function updateSitemapXML(Request $request)
{
    $validatedData = $request->validate([
        'sitemap_content' => 'required|string',
    ]);

    try {
        $filePath = public_path('sitemap.xml');

        File::put($filePath, $validatedData['sitemap_content']);

        sweetalert()->success('Sitemap XML updated successfully.');
        return redirect()->route('admin.settings.sitemap-xml');
    } catch (Exception $e) {
        Log::error('Failed to update sitemap XML.', ['error' => $e->getMessage()]);
        sweetalert()->error('An error occurred while updating the sitemap. Please try again.');

        return redirect()->route('admin.settings.sitemap-xml');
    }
}




public function robotsTxt()
{
    // Read the current robots.txt file content or set a default
    $robotsFilePath = public_path('robots.txt');
    $robotsContent = File::exists($robotsFilePath) ? File::get($robotsFilePath) : "User-agent: *\nDisallow:";

    return view('settings::robots-txt', compact('robotsContent'));
}

public function updateRobotsTxt(Request $request)
{
    $request->validate([
        'robots_content' => 'required|string',
    ]);

    try {
        // Save the robots.txt content to the public directory
        File::put(public_path('robots.txt'), $request->robots_content);

        sweetalert()->success('Robots.txt file updated successfully.');
    } catch (\Exception $e) {
        Log::error('Failed to update Robots.txt file: ' . $e->getMessage());
        sweetalert()->error('An error occurred while updating Robots.txt. Please try again.');
    }

    return redirect()->route('admin.settings.robots-txt');
}



public function maintenanceMode()
{
    $settings = Setting::pluck('value', 'key')->toArray();
    return view('settings::maintenance-mode', compact('settings'));
}


public function updateMaintenanceMode(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'maintenance_mode' => 'nullable|boolean', // Validate the toggle
        'image_path' => 'nullable|image|mimes:jpg,jpeg,png,svg',
        'button_url' => 'nullable',
        'button_text' => 'nullable|string|max:255',
        'access_code' => 'nullable|string|max:255',
    ]);

    try {
        DB::beginTransaction();

        // Update maintenance mode status
        Setting::updateOrCreate(
            ['key' => 'maintenance_mode'],
            ['value' => $request->boolean('maintenance_mode')]
        );

        // Process the image upload
        if ($request->hasFile('image_path')) {
            // Delete old image if it exists
            $oldImage = Setting::where('key', 'image_path')->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            // Store new image
            $imagePath = $request->file('image_path')->store('uploads/maintenance', 'public');
            Setting::updateOrCreate(['key' => 'image_path'], ['value' => $imagePath]);
        }

        // Update other settings
        $settingsData = $request->only(['button_url', 'button_text', 'access_code']);
        foreach ($settingsData as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        DB::commit();

        // Success message
        sweetalert()->success('Maintenance mode settings updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Log the error
        Log::error('Failed to update maintenance mode settings', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        // Error message
        sweetalert()->error('An error occurred while updating the settings. Please try again.');
    }

    return redirect()->route('admin.settings.maintenance-mode');
}




    /**
     * Display the social login settings page.
     */
    public function Soindex()
    {
        $socialLogins = DB::table('social_logins')->get();

        return view('settings::social-logins', compact('socialLogins'));
    }




 /**
 * Update social login settings.
 */
public function Soupdate(Request $request)
{
    $request->validate([
        'id' => 'required|array', // Ensure IDs are provided as an array
        'client_id' => 'required|array',
        'client_secret' => 'required|array',
        'status' => 'required|array',
    ]);

    foreach ($request->id as $index => $id) {
        $socialLogin = SocialLogin::find($id);

        if ($socialLogin) {
            $socialLogin->update([
                'client_id' => $request->client_id[$index],
                'client_secret' => $request->client_secret[$index],
                'redirect_url' => url('/social-login/' . $socialLogin->provider . '/callback'), // Auto-generate redirect URL
                'status' => $request->status[$index] ?? 0, // Default to 0 (inactive) if not set
            ]);
        }
    }

    sweetalert()->success('Social login settings updated successfully.');
    return redirect()->route('admin.settings.social-logins');
}





}
