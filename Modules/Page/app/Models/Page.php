<?php

namespace Modules\Page\Models;

use Modules\Page\Models\Seo;
use Modules\Page\Models\PageSection;
use Modules\Page\Models\SectionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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


    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('position');
    }

    public function sectionData(): HasManyThrough
    {
        return $this->hasManyThrough(
            SectionData::class,
            PageSection::class,
            'page_id', 
            'section_key',
            'id',
            'section_key'
        );
    }
}
