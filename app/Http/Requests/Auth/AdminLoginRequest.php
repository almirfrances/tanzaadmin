<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $loginField = $this->determineLoginField();
        $credentials = [
            $loginField => $this->input('login'),
            'password' => $this->input('password'),
        ];

        if (!Auth::guard('admin')->attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Determine the login field based on input.
     */
    protected function determineLoginField(): string
    {
        $login = $this->input('login');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        if (is_numeric($login)) {
            return 'phone';
        }

        return 'username';
    }

    /**
     * Ensure the login request is not rate-limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        $maxAttempts = 3; // Max attempts within 1 minute
        $maxTotalAttempts = 6; // Total attempts within the defined time frame
        $lockDuration = 60; // 1 minute block
        $banDuration = 900; // 15 minute ban

        // If more than the allowed attempts have been made, block for 1 minute or ban for 15 minutes
        if (RateLimiter::tooManyAttempts($this->throttleKey(), $maxAttempts)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());

            // If the admin has exceeded 6 attempts, apply a 15-minute ban
            if (RateLimiter::tooManyAttempts($this->throttleKey(), $maxTotalAttempts)) {
                $banSeconds = RateLimiter::availableIn($this->throttleKey());
                throw ValidationException::withMessages([
                    'login' => trans('auth.banned', [
                        'seconds' => $banSeconds,
                        'minutes' => ceil($banSeconds / 60)
                    ]),
                ]);
            }

            // If the admin has exceeded 3 attempts, apply 1-minute lock
            throw ValidationException::withMessages([
                'login' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
    }
}
