<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user('web')->id;

        return [
            'name' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,{$userId}",
            'phone' => "required|string|max:15|unique:users,phone,{$userId}",
            'email' => "required|email|max:255|unique:users,email,{$userId}",
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'The username is already in use.',
            'phone.unique' => 'The phone number is already in use.',
            'email.unique' => 'The email address is already in use.',
        ];
    }
}
