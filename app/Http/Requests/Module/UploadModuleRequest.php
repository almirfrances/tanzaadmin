<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class UploadModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Implement your authorization logic here.
        // For example, return auth()->user()->isSuperAdmin() ?? false;
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:zip', 'max:4048'], // max size 2MB (adjust as needed)
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please upload a module ZIP file.',
            'file.mimes' => 'Only ZIP files are allowed.',
            'file.max' => 'The ZIP file size should not exceed 4MB.',
        ];
    }
}
