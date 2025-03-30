<?php

namespace Modules\Users\Http\Controllers;

use App\Models\AdminModule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Users\Models\User;
use App\Providers\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Settings\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Modules\Users\Models\SocialLogin;
use Laravel\Socialite\Facades\Socialite;
use Modules\Users\Http\Requests\LoginRequest;
use Modules\Users\Http\Requests\RegisterRequest;
use Modules\Email\Http\Controllers\EmailController;
use Modules\Users\Http\Requests\UpdateUserAccountRequest;
use Modules\Users\Http\Requests\UserChangePasswordRequest;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        $activeProviders = SocialLogin::where('status', 1)->pluck('provider')->toArray();

        if (!in_array($provider, $activeProviders)) {
            sweetalert()->error('The selected social login provider is not active.');
            return redirect()->route('login');
        }

        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        try {
            // Retrieve user details from the social provider
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // Check if a user exists by email
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Log the user in without modifying details
                Auth::login($user);

                sweetalert()->success('Successfully logged in!');
                return redirect()->route('user.dashboard');
            }

            // Generate unique username
            $baseUsername = Str::slug($socialUser->getName(), '_');
            $username = $baseUsername;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . '_' . $counter++;
            }

            // Generate unique phone (optional placeholder)
            $phone = '999' . random_int(1000000, 9999999);
            while (User::where('phone', $phone)->exists()) {
                $phone = '999' . random_int(1000000, 9999999);
            }

            // Create a new user
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'username' => $username,
                'phone' => $phone,
                'password' => Hash::make(uniqid()), // Random password for security
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'email_verified_at' => now(), // Mark email as verified
            ]);


        // Send a welcome email
        $this->sendWelcomeEmail($user);


            // Log in the newly created user
            Auth::login($user);

            sweetalert()->success('Account created and logged in!');
            return redirect()->route('user.dashboard');
        } catch (\Exception $e) {
            Log::error('Social login failed: ' . $e->getMessage());
            sweetalert()->error('Failed to log in. Please try again.');
            return redirect()->route('login');
        }
    }

    /**
 * Send a welcome email to the user.
 */
protected function sendWelcomeEmail($user)
{
    if (AdminModule::isModuleEnabled('Email')) {
        try {
            $emailController = new EmailController();
            $emailController->sendDynamicEmail('Welcome Email', [
                'email' => $user->email,
                'name' => $user->name,
                'username' => $user->username,
                'site_name' => $settings['site_name'] ?? config('app.name'),
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
    }
}



/**
 * Show the registration form.
 */
public function showRegisterForm()
{
        // Fetch the setting value
        $enableRegisterForm = Setting::getValue('enable_register_form', true);

        // If registration is disabled, redirect to login with an error message
        if (!$enableRegisterForm) {
             return redirect()->route('login');
        }
    // Check if user registration is allowed
    $allowRegistration = Setting::getValue('allow_user_registration') ?? false;

    if (!$allowRegistration) {
        sweetalert()->error('User registration is currently disabled.');
        return redirect()->route('login');
    }

    return view('users::auth.register');
}




public function register(RegisterRequest $request)
{
    try {
        // Check if the Email module is active
        if (!AdminModule::isModuleEnabled('Email')) {
            sweetalert()->info('Email module is not active. Welcome email will not be sent.');
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send a welcome email if the Email module is active
        if (AdminModule::isModuleEnabled('Email')) {
            $emailController = new EmailController();
            $emailController->sendDynamicEmail('Welcome Email', [
                'email' => $user->email,
                'name' => $user->name,
                'username' => $user->username,
                'site_name' => $settings['site_name'] ?? config('app.name'),
            ]);
        }

        // Log the user in
        Auth::login($user);

        // SweetAlert success notification
        sweetalert()->success('Registration successful!');

        return redirect()->route('user.dashboard');
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('User registration failed: ' . $e->getMessage());

        // SweetAlert error notification
        sweetalert()->error('An error occurred while processing your registration.');

        return back()->withErrors(['error' => 'An error occurred while processing your registration.'])->withInput();
    }
}





    public function showEmailVerificationForm()
    {
        $email = Auth::user()->email;

        if (!$email) {
            return redirect()->route('login')->withErrors([
                'email' => 'No email verification request found. Please log in again.',
            ]);
        }

        return view('users::auth.verify-email');
    }



    public function verifyEmailCode(Request $request)
{
    $request->validate([
        'code' => 'required|numeric|digits:6',
    ]);

    $email = Auth::user()->email;

    // Fetch the verification record
    $record = DB::table('email_verifications')->where('email', $email)->first();

    if (!$record) {
        return redirect()->route('user.verify-email')->withErrors([
            'code' => 'Verification code has expired or is invalid. Please request a new code.',
        ]);
    }

    // Decrypt the verification code
    try {
        $decryptedCode = Crypt::decryptString($record->code);
    } catch (\Exception $e) {
        return redirect()->route('user.verify-email')->withErrors([
            'code' => 'An error occurred while processing the verification code. Please try again.',
        ]);
    }

    // Check if the entered code matches
    if ($request->code != $decryptedCode) {
        return redirect()->route('user.verify-email')->withErrors([
            'code' => 'Invalid verification code. Please try again.',
        ])->withInput();
    }

    // Mark email as verified
    $user = User::where('email', $email)->first(); // Fetch a fresh instance of the user from the database

    if (!$user) {
        return redirect()->route('login')->withErrors([
            'error' => 'User not found. Please log in again.',
        ]);
    }

    $user->email_verified_at = now();
    $user->save(); // Ensure changes are saved to the database

    // Clear the verification record
    DB::table('email_verifications')->where('email', $email)->delete();

    sweetalert()->success('Your email address has been successfully verified!');
    return redirect()->route('user.dashboard');
}



public function resendEmailCode()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors(['login' => 'Please log in to resend the verification code.']);
    }

    if ($user->email_verified_at) {
        sweetalert()->info('Your email is already verified.');
        return redirect()->route('user.dashboard');
    }

    try {
        $verificationCode = random_int(100000, 999999);
        $encryptedCode = Crypt::encryptString($verificationCode);

        // Update or insert verification record
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
            'site_name' => Setting::getValue('site_name'),
        ]);

        sweetalert()->success('A new verification code has been sent to your email.');
    } catch (\Exception $e) {
        Log::error('Failed to resend email verification code: ' . $e->getMessage());
        sweetalert()->error('Failed to resend the verification code. Please try again.');
    }

    return back();
}



        /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->intended(route('user.dashboard'));
        }

        $title = 'User Login';
        return view('users::auth.login', compact('title'));
    }



    public function login(LoginRequest $request)
    {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (is_numeric($request->login) ? 'phone' : 'username');

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];


        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('web')->user();

            if ($user->status !== 'active') {
                Auth::guard('web')->logout();
                sweetalert()->error('Your account is inactive. Please contact support.');
                return back()->withErrors(['login' => 'Your account is inactive.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }

         sweetalert()->error('The provided credentials do not match our records.');
        return back()->withErrors(['login' => 'The provided credentials do not match our records.'])->onlyInput('login');
    }
        /**
     * Logout the web.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        sweetalert()->warning('Logged out successfully.');
        return redirect()->route('login');
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

        return view('users::auth.user.forgot-password');
    }


    public function sendResetCode(Request $request)
    {
        $request->validate([
            'login' => 'required',
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->orWhere('phone', $request->login)
            ->first();

        if (!$user) {
            return back()->withErrors(['login' => 'No account found for the provided details.'])->withInput();
        }

        $resetCode = rand(100000, 999999);

        // Encrypt the reset code
        $encryptedCode = Crypt::encryptString($resetCode);

        // Save to database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $encryptedCode,
                'created_at' => now(),
            ]
        );

        // Save email in session for validation
        session(['reset_email' => $user->email]);

        // Send reset code email
        $emailController = new EmailController();
        $emailController->sendDynamicEmail('Password Reset Code', [
            'email' => $user->email,
            'name' => $user->name,
            'username' => $user->username,
            'code' => $resetCode,
            'site_name' => Setting::getValue('site_name'),
        ]);

        return redirect()->route('user.verify-reset-code')->with('status', 'Reset code sent to your email.');
    }


        /**
     * Show the form to verify the reset code.
     */
    public function showVerifyCodeForm()
    {

        return view('users::auth.user.verify-code');
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
        return redirect()->route('user.reset-password')->with('status', 'Code verified. You may now reset your password.');
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
            return redirect()->route('user.forgot-password')->withErrors(['login' => 'No reset request found.']);
        }

        return view('users::auth.user.reset-password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('user.forgot-password')->withErrors(['login' => 'Something went wrong. Please try again.']);
        }

        // Update the user's password
        $user->update(['password' => Hash::make($request->password)]);

        // Clean up
        session()->forget('reset_email');
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with('status', 'Password updated successfully. Please log in.');
    }




       // Display the Account tab view
       public function view()
       {
           $user = Auth::guard('web')->user();
           return view('users::auth.user.account', compact('user'));
       }

       public function update(UpdateUserAccountRequest $request)
       {
           $user = Auth::guard('web')->user();

           try {
               $user->update($request->only(['name', 'username', 'phone', 'email']));

               // Success notification
               sweetalert()->success('Account details updated successfully.');

               return redirect()->route('user.profile.account.view');
           } catch (\Exception $e) {
               // Log the error for debugging
               \Log::error('Account update failed', ['error' => $e->getMessage()]);

               // Error notification
               sweetalert()->error('Failed to update account details. Please try again.');

               return back();
           }
       }


       // Display the Security tab view
       public function security()
       {
           $user = Auth::guard('web')->user();
           return view('users::auth.user.security', compact('user'));
       }

       public function changePassword(UserChangePasswordRequest $request)
       {
           $user = Auth::guard('web')->user();

           try {
               $user->update(['password' => Hash::make($request->newPassword)]);

               // Success notification
               sweetalert()->success('Password updated successfully.');

               return back();
           } catch (\Exception $e) {
               // Log the error for debugging
               \Log::error('Password update failed', ['error' => $e->getMessage()]);

               // Error notification
               sweetalert()->error('Failed to update password. Please try again.');

               return back();
           }
       }

}
