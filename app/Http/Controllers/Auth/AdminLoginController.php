<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Admin;
use App\Models\AdminModule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Auth\AdminLoginRequest;
use Modules\Email\Http\Controllers\EmailController;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        $title = 'Admin Login';
        return view('auth.admin.login', compact('title'));
    }



    public function login(AdminLoginRequest $request)
    {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (is_numeric($request->login) ? 'phone' : 'username');

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $admin = Auth::guard('admin')->user();

            if ($admin->status !== 'active') {
                Auth::guard('admin')->logout();
                sweetalert()->error('Your account is inactive. Please contact support.');
                return back()->withErrors(['login' => 'Your account is inactive.']);
            }

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Notify admin on successful login
            $this->notifyOnSuccessfulLogin($admin);

            // Redirect to intended or fallback to dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // Notify admin on failed login attempt
        $this->notifyOnFailedLogin($request->login);

        sweetalert()->error('The provided credentials do not match our records.');
        return back()->withErrors(['login' => 'The provided credentials do not match our records.'])->onlyInput('login');
    }

    /**
     * Logout the admin.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        sweetalert()->warning('Logged out successfully.');
        return redirect()->route('admin.login');
    }




    /**
 * Notify admin on successful login.
 */
protected function notifyOnSuccessfulLogin($admin)
{
    if ($this->isEmailModuleActive() && Setting::getValue('notify_admin_on_login')) {
        $emailController = new EmailController();
        $data = [
            'email' => Setting::getValue('site_email'), // Admin email from settings
            'name' => Setting::getValue('site_name'),
            'username' => 'admin', // Fixed username
            'site_name' => Setting::getValue('site_name'), // Site name from settings
            'message' => 'A successful login to the admin panel was made.',
        ];

        $emailController->sendDynamicEmail('Successful Admin Login', $data);
    }
}

/**
 * Notify admin on failed login attempt.
 */
protected function notifyOnFailedLogin($login)
{
    if ($this->isEmailModuleActive() && Setting::getValue('notify_admin_on_login_fail')) {
        $emailController = new EmailController();
        $data = [
            'email' => Setting::getValue('site_email'), // Admin email from settings
            'name' => Setting::getValue('site_name'),
            'username' => 'admin', // Fixed username
            'message' => "A failed login attempt was made with the username or email: {$login}.",
        ];

        $emailController->sendDynamicEmail('Failed Admin Login Attempt', $data);
    }
}



    /**
     * Check if the Email module is active.
     */
    protected function isEmailModuleActive()
    {
        return AdminModule::where('name', 'Email')->where('status', true)->exists();
    }













    /**
     * Show the forgot password form.
     */
    public function showForgotPasswordForm()
    {
        // Check if the Email module is active
        if (!AdminModule::isModuleEnabled('Email')) {
            abort(403, 'The Email module is not active.');
        }

        return view('auth.admin.forgot-password');
    }


    public function sendResetCode(Request $request)
{
    $request->validate([
        'login' => 'required',
    ]);

    $admin = Admin::where('email', $request->login)
        ->orWhere('username', $request->login)
        ->orWhere('phone', $request->login)
        ->first();

    if (!$admin) {
        return back()->withErrors(['login' => 'No account found for the provided details.'])->withInput();
    }

    $resetCode = rand(100000, 999999);

    // Encrypt the reset code
    $encryptedCode = Crypt::encryptString($resetCode);

    // Save to database
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $admin->email],
        [
            'token' => $encryptedCode,
            'created_at' => now(),
        ]
    );

    // Save email in session for validation
    session(['reset_email' => $admin->email]);

    // Send reset code email
    $emailController = new EmailController();
    $emailController->sendDynamicEmail('Password Reset Code', [
        'email' => $admin->email,
        'name' => $admin->name,
        'username' => $admin->username,
        'code' => $resetCode,
        'site_name' => Setting::getValue('site_name'),
    ]);

    return redirect()->route('admin.verify-reset-code')->with('status', 'Reset code sent to your email.');
}


    /**
     * Show the form to verify the reset code.
     */
    public function showVerifyCodeForm()
    {

        return view('auth.admin.verify-code');
    }



    /**
 * Verify the reset code and allow password reset.
 */
public function verifyResetCode(Request $request)
{
    $request->validate([
        'reset_code' => 'required|numeric|digits:6',
    ]);

    // Fetch the reset record for the stored email in session
    $resetRecord = DB::table('password_reset_tokens')
        ->where('email', session('reset_email'))
        ->where('created_at', '>=', Carbon::now()->subMinutes(15))
        ->first();

    if (!$resetRecord) {
        return back()->withErrors(['reset_code' => 'Invalid or expired reset code.'])->withInput();
    }

    try {
        // Decrypt the stored token for comparison
        $storedResetCode = Crypt::decryptString($resetRecord->token);

        if ($storedResetCode !== $request->reset_code) {
            return back()->withErrors(['reset_code' => 'Invalid reset code.'])->withInput();
        }

        // Code is valid; proceed to reset password
        return redirect()->route('admin.reset-password')->with('status', 'Code verified. You may now reset your password.');
    } catch (Exception $e) {
        // Handle decryption errors
        return back()->withErrors(['reset_code' => 'Invalid or expired reset code.'])->withInput();
    }
}

    /**
     * Show the form to reset the password.
     */
    public function showResetPasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('admin.forgot-password')->withErrors(['login' => 'No reset request found.']);
        }

        return view('auth.admin.reset-password');
    }

    /**
     * Update the admin's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $email = session('reset_email');
        $admin = Admin::where('email', $email)->first();

        if (!$admin) {
            return redirect()->route('admin.forgot-password')->withErrors(['login' => 'Something went wrong. Please try again.']);
        }

        // Update the admin's password
        $admin->update(['password' => Hash::make($request->password)]);

        // Clean up
        session()->forget('reset_email');
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('admin.login')->with('status', 'Password updated successfully. Please log in.');
    }










}
