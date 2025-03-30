<?php

namespace Modules\Email\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Email\Database\Factories\EmailSettingFactory;

class EmailSetting extends Model
{
    use HasFactory;

    protected $fillable = ['provider', 'settings'];

    protected $casts = [
        'settings' => 'array',
    ];
}
