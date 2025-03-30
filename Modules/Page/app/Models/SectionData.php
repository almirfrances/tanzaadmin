<?php

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Page\Database\Factories\SectionDataFactory;

class SectionData extends Model
{
    use HasFactory;

       // Define the table name if it doesn't follow Laravel's naming conventions
       protected $table = 'sections_data';

       // Allow mass assignment for these fields
       protected $fillable = [
           'section_key',
           'content',
       ];
   
       // Cast the 'content' column to an array automatically
       protected $casts = [
           'content' => 'array',
       ];



           /**
     * Get the content attribute.
     *
     * If the stored value is double-encoded JSON, we decode it again.
     */
    public function getContentAttribute($value)
    {
        // First decode using the built-in cast
        $decoded = json_decode($value, true);

        // If the result is still a string, try decoding a second time.
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return $decoded ?: [];
    }

    
}
