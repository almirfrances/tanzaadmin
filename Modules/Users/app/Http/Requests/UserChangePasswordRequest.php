<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'currentPassword' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth('web')->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'newPassword' => [
                'required',
                'string',
                'min:8',
                'different:currentPassword',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/'
            ],
            'confirmPassword' => ['required', 'same:newPassword'],
        ];
    }

    public function messages(): array
    {
        return [
            'newPassword.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            'confirmPassword.same' => 'The password confirmation does not match the new password.',
        ];
    }
}
