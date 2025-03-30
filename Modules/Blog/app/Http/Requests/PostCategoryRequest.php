<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow authorized users to create/update categories
        return true; // Change this to your authorization logic if needed
    }

    public function rules()
    {
        // Define validation rules for post categories
        return [
            'name' => 'required|string|max:255|unique:post_categories,name,' . $this->route('post_category'), // Allow unique name except for the current category
            'slug' => 'nullable|string|max:255|unique:post_categories,slug,' . $this->route('post_category'), // Allow unique slug except for the current category
        ];
    }

    public function messages()
    {
        // Custom error messages
        return [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name already exists.',
            'slug.unique' => 'The category slug already exists.',
        ];
    }
}
