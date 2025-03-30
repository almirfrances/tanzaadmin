<?php

namespace Modules\Email\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorize all requests for now.
    }

    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'html_template' => 'required|string', // HTML content validation
            'from_name' => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'The email subject is required.',
            'html_template.required' => 'The email template body is required.',
            'from_name.required' => 'The "From Name" field is required.',
            'from_email.required' => 'The "From Email" field is required.',
            'from_email.email' => 'The "From Email" field must be a valid email address.',
        ];
    }
}
