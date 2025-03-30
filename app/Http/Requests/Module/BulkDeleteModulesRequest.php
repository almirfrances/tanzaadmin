<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class BulkDeleteModulesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'modules' => 'required|array',
        'modules.*' => 'string|exists:admin_modules,name',
        'remove_tables' => 'sometimes|boolean',
    ];
}
}
