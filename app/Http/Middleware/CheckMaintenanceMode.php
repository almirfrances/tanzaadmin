<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Settings\Models\Setting;
use App\Models\AdminModule;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verify if the "Settings" module is active
        $settingsModule = AdminModule::where('name', 'Settings')->where('status', true)->first();

        if (!$settingsModule) {
            // If the module is not active, allow requests to proceed as usual
            return $next($request);
        }

        // Retrieve maintenance mode settings
        $settings = Setting::pluck('value', 'key')->toArray();
        $isMaintenanceMode = $settings['maintenance_mode'] ?? false;
        $validAccessCode = $settings['access_code'] ?? null;

        // Check if maintenance mode is enabled
        if ($isMaintenanceMode) {
            // Check if the user has provided a valid access code
            if ($request->has('access_code')) {
                $providedCode = $request->get('access_code');
                if ($providedCode === $validAccessCode) {
                    // Store the valid access code in the session for subsequent requests
                    session(['maintenance_access_code' => $providedCode]);
                } else {
                    // Abort with a 403 error if the access code is invalid
                    return abort(403, 'Invalid access code.');
                }
            }

            // Check if the user has a valid access code stored in the session
            if (session('maintenance_access_code') !== $validAccessCode) {
                return response()->view('maintenance', [
                    'image_path' => $settings['image_path'] ?? null,
                    'button_url' => $settings['button_url'] ?? url('/'),
                    'button_text' => $settings['button_text'] ?? 'Back to Home',
                ]);
            }
        }

        // Proceed with the request if all conditions are met
        return $next($request);
    }
}
