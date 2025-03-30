<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Attempt to authenticate the user's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->checkRateLimit();

        $loginField = $this->determineLoginField();
        $credentials = [
            $loginField => $this->input('login'),
            'password' => $this->input('password'),
        ];

        if (!auth()->attempt($credentials, $this->boolean('remember'))) {
            // Increment the rate limiter
            RateLimiter::hit($this->throttleKey(), $this->getLockDuration());

            throw ValidationException::withMessages([
                'login' => $this->getErrorMessage(false),
            ]);
        }

        // Clear the throttle key on successful login
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
     * Check if the user has exceeded the rate limit.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function checkRateLimit(): void
    {
        $maxAttempts = 3; // Temporary lock threshold
        $banThreshold = 6; // Ban threshold
        $banDuration = 900; // Ban duration in seconds (15 minutes)
        $lockDuration = 60; // Lock duration in seconds (1 minute)

        $throttleKey = $this->throttleKey();

        // Ban logic
        if (RateLimiter::attempts($throttleKey) >= $banThreshold) {
            RateLimiter::hit($throttleKey, $banDuration);

            throw ValidationException::withMessages([
                'login' => $this->getErrorMessage(true, $banDuration),
            ]);
        }

        // Lockout logic
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'login' => $this->getErrorMessage(false, $seconds),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::lower($this->input('login')) . '|' . $this->ip();
    }

    /**
     * Get the lock duration.
     */
    protected function getLockDuration(): int
    {
        return 60; // Lock for 1 minute
    }

    /**
     * Get the error message based on lockout or ban.
     */
    protected function getErrorMessage(bool $isBan, int $seconds = 0): string
    {
        if ($isBan) {
            return sprintf(
                'Too many failed attempts. You are banned for %d minutes.',
                ceil($seconds / 60)
            );
        }

        return sprintf(
            'Too many failed attempts. Please try again in %d seconds.',
            $seconds
        );
    }
}
