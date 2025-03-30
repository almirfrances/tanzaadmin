<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminAccountRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user('admin')->can('update', $this->user('admin'));
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $this->user('admin')->id,
            'phone' => 'required|string|max:15|unique:admins,phone,' . $this->user('admin')->id,
            'email' => 'required|email|max:255|unique:admins,email,' . $this->user('admin')->id,
            'status' => 'required|in:active,inactive',
        ];
    }
}
