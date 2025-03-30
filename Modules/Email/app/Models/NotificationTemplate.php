<?php

namespace Modules\Email\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Email\Database\Factories\NotificationTemplateFactory;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'subject', 'body', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
