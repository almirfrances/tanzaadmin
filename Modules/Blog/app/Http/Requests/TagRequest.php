<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow authorized users to create/update tags
        return true; // Change this to your authorization logic if needed
    }

    public function rules()
    {
        // Define validation rules for tags
        $tagId = $this->route('tag') ? $this->route('tag')->id : null;

        return [
            'name' => 'required|string|max:255|unique:tags,name,' . $tagId,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tagId,
            'posts' => 'nullable|array', // Assuming posts are passed as an array of IDs
            'posts.*' => 'exists:posts,id', // Validate that each post ID exists in the posts table
        ];
    }

    public function messages()
    {
        // Custom error messages
        return [
            'name.required' => 'The tag name is required.',
            'name.unique' => 'The tag name already exists.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug already exists.',
            'posts.array' => 'The posts must be an array.',
            'posts.*.exists' => 'One or more posts do not exist.',
        ];
    }
}
