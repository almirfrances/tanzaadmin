<?php

namespace Modules\Page\Models;

use Modules\Page\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Page\Database\Factories\PageSectionFactory;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_key',
        'position',
    ];

    /**
     * Inverse relationship to the Page model.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
