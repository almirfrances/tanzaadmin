<?php

namespace App\Http\Controllers;

use Exception;
use ZipArchive;
use App\Models\AdminModule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Module\UploadModuleRequest;
use Nwidart\Modules\Facades\Module as ModuleFacade;
use App\Http\Requests\Module\BulkDeleteModulesRequest;
use App\Http\Requests\Module\BulkActivateModulesRequest;
use App\Http\Requests\Module\BulkDeactivateModulesRequest;

class ModulesManagementController extends Controller
{
    /**
                       /**
     * Display a listing of the modules with advanced functionalities.
     */
    public function index(Request $request)
    {
        // Retrieve query parameters for searching and sorting
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name'); // Default sort by name
        $sortOrder = $request->input('sort_order', 'asc'); // Default order ascending

        // Validate sort parameters to prevent SQL injection
        if (!in_array($sortBy, ['name', 'version', 'author', 'status'])) {
            $sortBy = 'name';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        // Build the query with search and sorting
        $query = AdminModule::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $modules = $query->orderBy($sortBy, $sortOrder)->paginate(12)->withQueryString();

        return view('modules.index', compact('modules', 'search', 'sortBy', 'sortOrder'));
    }

    public function upload(UploadModuleRequest $request)
    {
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // 1) Retrieve the uploaded file
            $file = $request->file('file');

            // 2) Initialize ZipArchive
            $zip = new ZipArchive;

            // 3) Open the uploaded ZIP file directly from its temporary location
            if ($zip->open($file->getRealPath()) !== true) {
                throw new Exception('Unable to open the ZIP file. Please ensure it is a valid ZIP archive.');
            }

            // 4) Locate module.json within the ZIP
            $moduleJsonIndex = $zip->locateName('module.json', ZipArchive::FL_NOCASE | ZipArchive::FL_NODIR);

            if ($moduleJsonIndex === false) {
                throw new Exception('module.json not found in the uploaded ZIP.');
            }

            // 5) Extract module.json content
            $moduleJsonContent = $zip->getFromIndex($moduleJsonIndex);

            if (!$moduleJsonContent) {
                throw new Exception('Unable to read module.json from the ZIP file.');
            }

            // 6) Decode JSON
            $moduleData = json_decode($moduleJsonContent, true);

            if (
                !$moduleData ||
                empty($moduleData['name']) ||
                empty($moduleData['version']) ||
                !is_string($moduleData['name']) ||
                !is_string($moduleData['version'])
            ) {
                throw new Exception('Invalid module.json. It must contain valid "name" and "version" fields.');
            }

            // 7) Extract and sanitize metadata
            $name        = trim($moduleData['name']);
            $version     = trim($moduleData['version']);
            $description = isset($moduleData['description']) ? trim($moduleData['description']) : null;
            $author      = isset($moduleData['author']) ? trim($moduleData['author']) : null;
            $authorUrl   = isset($moduleData['author_url']) ? trim($moduleData['author_url']) : null;

            // Additional Validation
            if (!preg_match('/^[A-Za-z0-9_-]+$/', $name)) {
                throw new Exception('Module name contains invalid characters. Only letters, numbers, underscores, and hyphens are allowed.');
            }

            if (!preg_match('/^\d+\.\d+\.\d+$/', $version)) { // Simple semantic versioning check
                throw new Exception('Module version must follow semantic versioning (e.g., 1.0.0).');
            }

            // 8) Define the final module path
            $finalPath = base_path("Modules/{$name}");

            // 9) Check if module already exists
            $existingModule = AdminModule::where('name', $name)->first();

            if ($existingModule) {
                $currentVersion = $existingModule->version;

                // Version comparison
                if (version_compare($version, $currentVersion, '==')) {
                    throw new Exception("Module [{$name}] with version [{$version}] already exists.");
                }

                if (version_compare($version, $currentVersion, '<')) {
                    throw new Exception("Cannot install an older version. Current version is [{$currentVersion}].");
                }

                // Proceed with upgrade
                // 10) Backup existing module
                if (File::exists($finalPath)) {
                    $backupPath = base_path("Modules/_backup_{$name}_" . now()->format('Ymd_His'));
                    if (!File::move($finalPath, $backupPath)) {
                        throw new Exception("Failed to backup existing module [{$name}].");
                    }
                }

                // 11) Ensure the final directory exists
                if (!File::exists($finalPath)) {
                    if (!File::makeDirectory($finalPath, 0755, true)) {
                        throw new Exception("Failed to create directory for module [{$name}].");
                    }
                }

                // 12) Extract all files to final path
                if (!$zip->extractTo($finalPath)) {
                    throw new Exception('Failed to extract the ZIP file to the Modules directory.');
                }

                // 13) Close the ZIP after extraction
                $zip->close();

                // 14) Update DB record
                $existingModule->update([
                    'version'     => $version,
                    'description' => $description,
                    'author'      => $author,
                    'author_url'  => $authorUrl,
                ]);

                // 15) Optional: Run migrations and seeds if module is active
                if ($existingModule->status) {
                    Artisan::call('module:migrate', ['module' => $name]);
                    // Uncomment the following line if you want to run seeds automatically
                    Artisan::call('module:seed', ['module' => $name]);
                }

                // Commit the transaction
                DB::commit();

                // Log the upgrade action
                Log::info("Module [{$name}] upgraded from version [{$currentVersion}] to [{$version}].");

                sweetalert()->success("Upgraded module [{$name}] from version [{$currentVersion}] to [{$version}].");
                return redirect()
                    ->route('admin.modules.index');
            }

            // 16) Proceed with new module installation
            // 16.1) Create DB record
            $moduleRecord = AdminModule::create([
                'name'        => $name,
                'version'     => $version,
                'description' => $description,
                'author'      => $author,
                'author_url'  => $authorUrl,
                'status'      => false, // Initially inactive
            ]);

            // 17) Ensure the final directory exists
            if (!File::exists($finalPath)) {
                if (!File::makeDirectory($finalPath, 0755, true)) {
                    // Rollback the DB record if directory creation fails
                    DB::rollBack();
                    $moduleRecord->delete();
                    throw new Exception("Failed to create directory for module [{$name}].");
                }
            }

            // 18) Extract all files to final path
            if (!$zip->extractTo($finalPath)) {
                // Rollback the DB record if extraction fails
                DB::rollBack();
                $moduleRecord->delete();
                throw new Exception('Failed to extract the ZIP file to the Modules directory.');
            }

            // 19) Close the ZIP after extraction
            $zip->close();

            // 20) Optionally, run migrations and seeds if desired
            // Example: Uncomment the following lines if you want to run migrations immediately after upload
            /*
            Artisan::call('module:migrate', ['module' => $name]);
            Artisan::call('module:seed', ['module' => $name]);
            */

            // 21) Commit the transaction
            DB::commit();

            // Log the installation action
            Log::info("New module [{$name}] version [{$version}] uploaded successfully.");

            sweetalert()->success("Module [{$name}] uploaded successfully. You can now activate it.");
            return redirect()
                ->route('admin.modules.index');
        } catch (Exception $e) {
            // Rollback the transaction in case of any errors
            DB::rollBack();

            // Log the error details
            Log::error("Module Upload Error: " . $e->getMessage());
            sweetalert()->error(  $e->getMessage());
            // Redirect back with error message
            return redirect()
                ->route('admin.modules.index');
        }
    }

                          /**
 * Activate a module by enabling it in NWIDART and running migrations.
 *
 * @param  string  $moduleName
 * @return \Illuminate\Http\RedirectResponse
 */
public function activate(string $moduleName)
{
    try {
        // Start a database transaction
        DB::beginTransaction();

        // Locate DB record
        $moduleRecord = AdminModule::where('name', $moduleName)->firstOrFail();

        if ($moduleRecord->status) {
            throw new Exception("Module [{$moduleName}] is already active.");
        }

        if (!Module::has($moduleName)) {
            throw new Exception("Module [{$moduleName}] does not exist in the Modules directory.");
        }

        $module = Module::find($moduleName);

        if (!$module) {
            throw new Exception("Failed to locate module [{$moduleName}].");
        }

        if ($module->isEnabled()) {
            throw new Exception("Module [{$moduleName}] is already enabled in NWIDART.");
        }

        $module->enable();
        $moduleRecord->update(['status' => true]);

        DB::commit(); // Commit the transaction

        // Run migrations and seeds outside the transaction
        Artisan::call('module:migrate', ['module' => $moduleName, '--force' => true]);
        Artisan::call('module:seed', ['module' => $moduleName, '--force' => true]);

        Log::info("Module [{$moduleName}] activated successfully.");
        sweetalert()->success("Module [{$moduleName}] activated successfully.");

        return redirect()->route('admin.modules.index');
    } catch (Exception $e) {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        Log::error("Module Activation Error for [{$moduleName}]: " . $e->getMessage());
        sweetalert()->error($e->getMessage());

        return redirect()->route('admin.modules.index');
    }
}




/**
 * Deactivate a module by disabling it in NWIDART.
 * Optionally remove tables if requested.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  string  $moduleName
 * @return \Illuminate\Http\RedirectResponse
 */
public function deactivate(Request $request, string $moduleName)
{
    try {
        DB::beginTransaction();

        $moduleRecord = AdminModule::where('name', $moduleName)->firstOrFail();

        if (!$moduleRecord->status) {
            throw new Exception("Module [{$moduleName}] is already inactive.");
        }

        if (!Module::has($moduleName)) {
            throw new Exception("Module [{$moduleName}] does not exist in the Modules directory.");
        }

        $module = Module::find($moduleName);

        if (!$module) {
            throw new Exception("Failed to locate module [{$moduleName}].");
        }

        if (!$module->isEnabled()) {
            throw new Exception("Module [{$moduleName}] is already disabled in NWIDART.");
        }

        $module->disable();
        $moduleRecord->update(['status' => false]);

        DB::commit();

        // Run migrations reset outside the transaction
        if ($request->boolean('remove_tables')) {
            Artisan::call('module:migrate-reset', [
                'module' => $moduleName,
                '--force' => true,
            ]);
        }

        $message = "Module [{$moduleName}] deactivated successfully.";
        if ($request->boolean('remove_tables')) {
            $message .= " Database tables have been removed.";
        }

        Log::info($message);
        sweetalert()->success($message);

        return redirect()->route('admin.modules.index');
    } catch (Exception $e) {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        Log::error("Module Deactivation Error for [{$moduleName}]: " . $e->getMessage());
        sweetalert()->error($e->getMessage());

        return redirect()->route('admin.modules.index');
    }
}


       /**
     * Delete a module from the database and filesystem, if it's inactive.
     * Optionally remove database tables first.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $moduleName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, string $moduleName)
    {
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // 1) Locate DB record
            $moduleRecord = AdminModule::where('name', $moduleName)->firstOrFail();

            // 2) Ensure module is inactive
            if ($moduleRecord->status) {
                throw new Exception("Cannot delete an active module. Please deactivate [{$moduleName}] first.");
            }

            // 3) Validate module existence in the filesystem
            $modulePath = base_path("Modules/{$moduleName}");
            if (!File::exists($modulePath)) {
                throw new Exception("Module directory [{$moduleName}] does not exist.");
            }

            // 4) Optionally remove DB tables
            $removeTables = $request->boolean('remove_tables');
            if ($removeTables) {
                // Reset migrations specific to the module
                Artisan::call('module:migrate-reset', [
                    'module' => $moduleName,
                    '--force' => true,
                ]);
            }

            // 5) Delete module files
            if (!File::deleteDirectory($modulePath)) {
                throw new Exception("Failed to delete the module directory [{$moduleName}].");
            }

            // 6) Delete DB record
            $moduleRecord->delete();

            // 7) Commit the transaction
            DB::commit();

            // 8) Log the deletion action
            Log::info("Module [{$moduleName}] deleted successfully." . ($removeTables ? " Database tables removed." : ""));
            sweetalert()->success("Module [{$moduleName}] has been deleted successfully." . ($removeTables ? " Database tables have been removed." : ""));


            // 9) Redirect back with a success message
            return redirect()
                ->route('admin.modules.index');
        } catch (Exception $e) {
            // Rollback the transaction in case of any errors
            DB::rollBack();

            // Log the error details
            Log::error("Module Deletion Error for [{$moduleName}]: " . $e->getMessage());
            sweetalert()->error(['module' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()
                ->route('admin.modules.index');
        }
    }



    public function bulkActivate(BulkActivateModulesRequest $request)
    {
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // 1) Retrieve and validate the modules from the request
            $modules = $request->input('modules', []);

            if (empty($modules)) {
                throw new Exception('No modules selected for activation.');
            }

            // 2) Initialize arrays to track successes and failures
            $activatedModules = [];
            $failedModules = [];

            // 3) Loop through each module for activation
            foreach ($modules as $moduleName) {
                // 3.1) Locate the DB record
                $moduleRecord = AdminModule::where('name', $moduleName)->first();

                if (!$moduleRecord) {
                    $failedModules[] = "{$moduleName} (not found)";
                    continue;
                }

                // 3.2) Check if the module is already active
                if ($moduleRecord->status) {
                    // Optionally, track already active modules
                    $activatedModules[] = "{$moduleName} (already active)";
                    continue;
                }

                // 3.3) Validate module existence in NWIDART
                if (!Module::has($moduleName)) {
                    $failedModules[] = "{$moduleName} (not found in Modules directory)";
                    continue;
                }

                $module = Module::find($moduleName);

                if (!$module) {
                    $failedModules[] = "{$moduleName} (failed to locate in NWIDART)";
                    continue;
                }

                // 3.4) Check if module is already enabled in NWIDART
                if ($module->isEnabled()) {
                    $failedModules[] = "{$moduleName} (already enabled in NWIDART)";
                    // Optionally, update DB record if discrepancies are found
                    $moduleRecord->update(['status' => true]);
                    $activatedModules[] = "{$moduleName} (status updated)";
                    continue;
                }

                // 3.5) Attempt to enable the module
                try {
                    $module->enable();

                    // 3.6) Run migrations specific to the module
                    Artisan::call('module:migrate', [
                        'module' => $moduleName,
                        '--force' => true, // Ensures migrations run without prompts
                    ]);

                    // Optionally, run seeds if necessary
                    Artisan::call('module:seed', [
                        'module' => $moduleName,
                        '--force' => true,
                    ]);

                    // 3.7) Update the DB record to mark as active
                    $moduleRecord->update(['status' => true]);

                    // 3.8) Track successful activation
                    $activatedModules[] = $moduleName;

                    // 3.9) Log the successful activation
                    Log::info("Module [{$moduleName}] activated successfully.");
                } catch (Exception $e) {
                    // 3.10) Handle activation failures
                    $failedModules[] = "{$moduleName} ({$e->getMessage()})";
                    Log::error("Failed to activate module [{$moduleName}]: " . $e->getMessage());
                }
            }

            // 4) Commit the transaction
            DB::commit();

            // 5) Prepare the feedback message
            $successMessage = !empty($activatedModules)
                ? 'Activated modules: ' . implode(', ', $activatedModules) . '.'
                : '';
            $errorMessage = !empty($failedModules)
                ? 'Failed to activate modules: ' . implode(', ', $failedModules) . '.'
                : '';

            // Use SweetAlert for notifications
            if (!empty($activatedModules)) {
                sweetalert()->success($successMessage);
            }

            if (!empty($failedModules)) {
                sweetalert()->warning($errorMessage);
            }

            // 6) Redirect back to modules index
            return redirect()->route('admin.modules.index');
        } catch (Exception $e) {
            // Rollback the transaction in case of any unexpected errors
            DB::rollBack();

            // Log the error details
            Log::error("Bulk Activation Error: " . $e->getMessage());

            // Use SweetAlert for error notification
            sweetalert()->error($e->getMessage());

            // Redirect back with an error message
            return redirect()->route('admin.modules.index');
        }
    }




/**
 * Bulk Deactivate Modules
 *
 * Deactivates multiple modules by disabling them in NWIDART and optionally removing their database tables.
 *
 * @param  \App\Http\Requests\BulkDeactivateModulesRequest  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function bulkDeactivate(BulkDeactivateModulesRequest $request)
{
    // Start a database transaction to ensure atomicity
    DB::beginTransaction();

    try {
        // 1) Retrieve and validate the modules from the request
        $modules = $request->input('modules', []);

        if (empty($modules)) {
            throw new Exception('No modules selected for deactivation.');
        }

        // 2) Initialize arrays to track successes and failures
        $deactivatedModules = [];
        $failedModules = [];

        // 3) Determine if database tables should be removed
        $removeTables = $request->boolean('remove_tables', false);

        // 4) Loop through each module for deactivation
        foreach ($modules as $moduleName) {
            // 4.1) Locate the DB record
            $moduleRecord = AdminModule::where('name', $moduleName)->first();

            if (!$moduleRecord) {
                $failedModules[] = "{$moduleName} (not found)";
                continue;
            }

            // 4.2) Check if the module is already inactive
            if (!$moduleRecord->status) {
                $deactivatedModules[] = "{$moduleName} (already inactive)";
                continue;
            }

            // 4.3) Validate module existence in NWIDART
            if (!Module::has($moduleName)) {
                $failedModules[] = "{$moduleName} (not found in Modules directory)";
                continue;
            }

            $module = Module::find($moduleName);

            if (!$module) {
                $failedModules[] = "{$moduleName} (failed to locate in NWIDART)";
                continue;
            }

            // 4.4) Check if module is already disabled in NWIDART
            if (!$module->isEnabled()) {
                $failedModules[] = "{$moduleName} (already disabled in NWIDART)";
                $moduleRecord->update(['status' => false]);
                $deactivatedModules[] = "{$moduleName} (status updated)";
                continue;
            }

            // 4.5) Attempt to disable the module
            try {
                $module->disable();

                // 4.6) Optionally remove DB tables if requested
                if ($removeTables) {
                    Artisan::call('module:migrate-reset', [
                        'module' => $moduleName,
                        '--force' => true,
                    ]);
                }

                // 4.7) Update the DB record to mark as inactive
                $moduleRecord->update(['status' => false]);

                // 4.8) Track successful deactivation
                $deactivatedModules[] = $moduleName;

                // 4.9) Log the successful deactivation
                Log::info("Module [{$moduleName}] deactivated successfully." . ($removeTables ? " Database tables removed." : ""));
            } catch (Exception $e) {
                $failedModules[] = "{$moduleName} ({$e->getMessage()})";
                Log::error("Failed to deactivate module [{$moduleName}]: " . $e->getMessage());
            }
        }

        // 5) Commit the transaction
        DB::commit();

        // 6) Prepare the feedback message
        $successMessage = !empty($deactivatedModules)
            ? 'Deactivated modules: ' . implode(', ', $deactivatedModules) . '.'
            : '';
        $errorMessage = !empty($failedModules)
            ? 'Failed to deactivate modules: ' . implode(', ', $failedModules) . '.'
            : '';

        // Use SweetAlert for notifications
        if (!empty($deactivatedModules)) {
            sweetalert()->success($successMessage);
        }

        if (!empty($failedModules)) {
            sweetalert()->warning($errorMessage);
        }

        // 7) Redirect back to modules index
        return redirect()->route('admin.modules.index');
    } catch (Exception $e) {
        // Rollback the transaction in case of any unexpected errors
        DB::rollBack();

        // Log the error details
        Log::error("Bulk Deactivation Error: " . $e->getMessage());

        // Use SweetAlert for error notification
        sweetalert()->error($e->getMessage());

        // Redirect back with an error message
        return redirect()->route('admin.modules.index');
    }
}



public function bulkDelete(BulkDeleteModulesRequest $request)
{
    // Start a database transaction to ensure atomicity
    DB::beginTransaction();

    try {
        // 1) Retrieve and validate the modules from the request
        $modules = $request->input('modules', []);

        if (empty($modules)) {
            throw new Exception('No modules selected for deletion.');
        }

        // 2) Initialize arrays to track successes and failures
        $deletedModules = [];
        $failedModules = [];

        // 3) Determine if database tables should be removed
        $removeTables = $request->boolean('remove_tables', false);

        // 4) Loop through each module for deletion
        foreach ($modules as $moduleName) {
            // 4.1) Locate the DB record
            $moduleRecord = AdminModule::where('name', $moduleName)->first();

            if (!$moduleRecord) {
                $failedModules[] = "{$moduleName} (not found)";
                continue;
            }

            // 4.2) Ensure module is inactive before deletion
            if ($moduleRecord->status) {
                $failedModules[] = "{$moduleName} (active)";
                continue;
            }

            // 4.3) Validate module existence in NWIDART
            if (!Module::has($moduleName)) {
                $failedModules[] = "{$moduleName} (not found in Modules directory)";
                continue;
            }

            $module = Module::find($moduleName);

            if (!$module) {
                $failedModules[] = "{$moduleName} (failed to locate in NWIDART)";
                continue;
            }

            // 4.4) Attempt to disable the module if it's enabled (redundant check)
            if ($module->isEnabled()) {
                try {
                    $module->disable();
                    Log::warning("Module [{$moduleName}] was active during deletion. Disabled automatically.");
                } catch (Exception $e) {
                    $failedModules[] = "{$moduleName} (failed to disable: {$e->getMessage()})";
                    Log::error("Failed to disable module [{$moduleName}] during deletion: " . $e->getMessage());
                    continue;
                }
            }

            // 4.5) Optionally remove DB tables if requested
            if ($removeTables) {
                try {
                    Artisan::call('module:migrate-reset', [
                        'module' => $moduleName,
                        '--force' => true,
                    ]);
                    Log::info("Database tables for module [{$moduleName}] have been reset.");
                } catch (Exception $e) {
                    $failedModules[] = "{$moduleName} (failed to reset migrations: {$e->getMessage()})";
                    Log::error("Failed to reset migrations for module [{$moduleName}]: " . $e->getMessage());
                    continue;
                }
            }

            // 4.6) Delete module files
            $modulePath = base_path("Modules/{$moduleName}");
            if (File::exists($modulePath)) {
                try {
                    File::deleteDirectory($modulePath);
                    Log::info("Module directory [{$moduleName}] deleted successfully.");
                } catch (Exception $e) {
                    $failedModules[] = "{$moduleName} (failed to delete files: {$e->getMessage()})";
                    Log::error("Failed to delete module directory [{$moduleName}]: " . $e->getMessage());
                    continue;
                }
            } else {
                Log::warning("Module directory [{$moduleName}] does not exist. Skipping file deletion.");
            }

            // 4.7) Delete DB record
            try {
                $moduleRecord->delete();
                $deletedModules[] = $moduleName;
                Log::info("Module [{$moduleName}] deleted from the database successfully.");
            } catch (Exception $e) {
                $failedModules[] = "{$moduleName} (failed to delete DB record: {$e->getMessage()})";
                Log::error("Failed to delete database record for module [{$moduleName}]: " . $e->getMessage());
                continue;
            }
        }

        // 5) Commit the transaction
        DB::commit();

        // 6) Prepare the feedback message
        $successMessage = !empty($deletedModules)
            ? 'Deleted modules: ' . implode(', ', $deletedModules) . '.'
            : '';
        $errorMessage = !empty($failedModules)
            ? 'Failed to delete modules: ' . implode(', ', $failedModules) . '.'
            : '';

        // Use SweetAlert for notifications
        if (!empty($deletedModules)) {
            sweetalert()->success($successMessage);
        }

        if (!empty($failedModules)) {
            sweetalert()->warning($errorMessage);
        }

        // 7) Redirect back to modules index
        return redirect()->route('admin.modules.index');
    } catch (Exception $e) {
        // Rollback the transaction in case of any unexpected errors
        DB::rollBack();

        // Log the error details
        Log::error("Bulk Deletion Error: " . $e->getMessage());

        // Use SweetAlert for error notification
        sweetalert()->error($e->getMessage());

        // Redirect back with an error message
        return redirect()->route('admin.modules.index');
    }
}

}
