<?php

namespace Modules\Email\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Email\Database\Factories\GlobalTemplateFactory;

class GlobalTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'html_template', 'shortcodes', 'subject', 'from_name', 'from_email'];

    protected $casts = [
        'shortcodes' => 'array',
    ];
}
