<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow authorized users to create/update posts
        return true; // Change this to your authorization logic if needed
    }

    public function rules()
    {
        // Define validation rules for posts
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . ($this->post ? $this->post->id : 'NULL'),
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'post_category_id' => 'required|exists:post_categories,id', // Ensure the category exists
            'tags' => 'nullable|string', // Comma-separated tags
        ];
    }

    public function messages()
    {
        // Custom error messages
        return [
            'title.required' => 'The post title is required.',
            'content.required' => 'The post content is required.',
            'featured_image.image' => 'The featured image must be a valid image file.',
            'post_category_id.required' => 'Please select a category for the post.',
            'post_category_id.exists' => 'The selected category does not exist.',
        ];
    }
}
