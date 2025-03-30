<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AdminChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'currentPassword' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth('admin')->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'newPassword' => ['required', 'string', 'min:8', 'different:currentPassword', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&#]/'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ];
    }
}
