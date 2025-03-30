<?php

namespace Modules\Page\Models;

use Modules\Page\Models\Seo;
use Modules\Page\Models\PageSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Page\Database\Factories\PageFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_closed',
    ];

    /**
     * One-to-One relationship with SEO settings.
     */
    public function seo()
    {
        return $this->hasOne(Seo::class);
    }

    /**
     * One-to-Many relationship with page sections.
     */
    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('position');
    }
}
