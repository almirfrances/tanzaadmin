<?php

namespace Modules\Email\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationTemplateRequest extends FormRequest
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
            // 'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            // 'name.required' => 'The template name is required.',
            'subject.required' => 'The template subject is required.',
            'body.required' => 'The template body is required.',
            'status.required' => 'The template status is required.',
        ];
    }
}
