<?php

namespace Modules\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Ticket\Database\Factories\TicketSettingFactory;

class TicketSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];
}
