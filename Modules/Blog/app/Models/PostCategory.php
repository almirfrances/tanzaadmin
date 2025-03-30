<?php

namespace Modules\Blog\Models;

use Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Blog\Database\Factories\PostCategoryFactory;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
