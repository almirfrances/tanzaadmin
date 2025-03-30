<?php

namespace Modules\Users\Http\Middleware;

use Closure;
use App\Models\AdminModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Modules\Email\Http\Controllers\EmailController;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('web')->user();

        if ($user && !$user->email_verified_at) {
            // Check if Settings and Email modules are active
            if (!AdminModule::isModuleEnabled('Settings') || !AdminModule::isModuleEnabled('Email')) {
                return $next($request); // Bypass if modules are not active
            }

            // Retrieve settings
            $settings = Setting::pluck('value', 'key')->toArray();
            $requireEmailConfirmation = $settings['require_email_confirmation'] ?? 0;

            if ($requireEmailConfirmation) {
                // Check or generate verification code
                $existingVerification = DB::table('email_verifications')->where('email', $user->email)->first();

                if (!$existingVerification || now()->diffInMinutes($existingVerification->created_at) > 15) {
                    $verificationCode = random_int(100000, 999999);
                    $encryptedCode = Crypt::encryptString($verificationCode);

                    // Save the code
                    DB::table('email_verifications')->updateOrInsert(
                        ['email' => $user->email],
                        ['code' => $encryptedCode, 'created_at' => now()]
                    );

                    // Send the email
                    $emailController = new EmailController();
                    $emailController->sendDynamicEmail('Verify Your Email Address', [
                        'email' => $user->email,
                        'name' => $user->name,
                        'username' => $user->username,
                        'code' => $verificationCode,
                        'site_name' => $settings['site_name'] ?? config('app.name'),
                    ]);
                }

                return redirect()->route('user.verify-email')
                    ->with('status', 'A verification code has been sent to your email.');
            }

            // Auto-verify if email confirmation is not required
            $user->update(['email_verified_at' => now()]);
        }

        return $next($request);
    }
}
