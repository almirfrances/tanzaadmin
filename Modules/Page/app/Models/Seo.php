<?php

namespace Modules\Page\Models;

use Modules\Page\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Page\Database\Factories\SeoFactory;

class Seo extends Model
{
    use HasFactory;

        // Explicitly set the table name
        protected $table = 'page_seos';

        protected $fillable = [
            'page_id',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'seo_image',
        ];
    
        /**
         * One-to-One inverse relationship with Page.
         */
        public function page()
        {
            return $this->belongsTo(Page::class);
        }
}
