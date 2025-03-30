<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Post;
use App\Http\Controllers\Controller;
use Modules\Settings\Models\Setting;
use Modules\Blog\Models\PostCategory;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Http\Requests\PostRequest;
use Modules\Blog\Http\Requests\PostCategoryRequest;

class BlogController extends Controller
{
    // Post Methods

    /**
     * Display a listing of the posts.
     */
public function index(Request $request)
{
    $query = Post::with('category', 'tags');

    // Filter by status if it's provided
    if ($request->has('status') && in_array($request->status, ['published', 'draft'])) {
        $query->where('status', $request->status);
    }

    // Search by title if a search term is provided
    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $posts = $query->paginate(10); // Use pagination

    return view('blog::admin.blog.index', compact('posts'));
}


    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = PostCategory::all();
        $tinymceApiKey = Setting::where('key', 'tinymce_api')->value('value');
        return view('blog::admin.blog.form', compact('categories', 'tinymceApiKey'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('uploads/posts', 'public');
        }

        $post = Post::create($data);
        $this->handleTags($post, $request->input('tags'));

        sweetalert()->success('Post created successfully!');
        return redirect()->route('admin.blog.index');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        $tinymceApiKey = Setting::where('key', 'tinymce_api')->value('value');
        return view('blog::admin.blog.form', compact('post', 'categories', 'tinymceApiKey'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::delete('public/' . $post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('uploads/posts', 'public');
        }

        $post->update($data);
        $this->handleTags($post, $request->input('tags'));

        sweetalert()->success('Post updated successfully!');
        return redirect()->route('admin.blog.index');
    }

         /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        sweetalert()->success('Post deleted successfully!');
        return redirect()->route('admin.blog.index');
    }

    // Category Methods

    /**
 * Display a listing of the categories.
 */
public function indexCategory()
{
    $categories = PostCategory::paginate(10);
    return view('blog::admin.blog.categories.index', compact('categories'));
}

    /**
     * Store a newly created category in storage.
     */
    public function storeCategory(PostCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        PostCategory::create($data);

        sweetalert()->success('Category created successfully!');
        return redirect()->route('admin.blog.categories.index');
    }

    /**
     * Update the specified category in storage.
     */
    public function updateCategory(PostCategoryRequest $request, PostCategory $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        sweetalert()->success('Category updated successfully!');
        return redirect()->route('admin.blog.categories.index');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroyCategory(PostCategory $category)
    {
        $category->delete();
        sweetalert()->success('Category deleted successfully!');
        return redirect()->route('admin.blog.categories.index');
    }

    // Helper Methods

    /**
     * Handle the creation and association of tags with the post.
     */
    private function handleTags(Post $post, $tags)
    {
        if ($tags) {
            $tagNames = array_map('trim', explode(',', $tags));
            $tagIds = array_map(function ($tagName) {
                return Tag::firstOrCreate(['name' => $tagName, 'slug' => Str::slug($tagName)])->id;
            }, $tagNames);
            $post->tags()->sync($tagIds);
        }
    }
}
