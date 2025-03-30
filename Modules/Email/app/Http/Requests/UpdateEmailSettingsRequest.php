<?php

namespace Modules\Email\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow only authenticated users if needed.
    }

    public function rules()
    {
        $rules = [
            'provider' => 'required|string|in:php_mailer,smtp,sendgrid,mailjet',
            'test_email' => 'nullable|email',
        ];

        // Dynamic validation based on provider
        switch ($this->provider) {
            case 'php_mailer':
                $rules['php_mailer_email'] = 'required|email';
                break;
            case 'smtp':
                $rules = array_merge($rules, [
                    'smtp_email' => 'required|email',
                    'smtp_host' => 'required|string|max:255',
                    'smtp_port' => 'required|integer',
                    'smtp_encryption' => 'required|string|in:tls,ssl',
                    'smtp_username' => 'required|string',
                    'smtp_password' => 'required|string',
                ]);
                break;
            case 'sendgrid':
                $rules['sendgrid_app_key'] = 'required|string';
                break;
            case 'mailjet':
                $rules = array_merge($rules, [
                    'mailjet_api_public_key' => 'required|string',
                    'mailjet_api_secret_key' => 'required|string',
                ]);
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'provider.required' => 'Please select an email provider.',
            'test_email.email' => 'Please enter a valid email address for testing.',
        ];
    }
}
