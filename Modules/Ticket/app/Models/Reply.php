<?php

namespace Modules\Ticket\Models;

use App\Models\Admin;
use Modules\Users\Models\User;
use Modules\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Ticket\Database\Factories\ReplyFactory;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'admin_id',
        'message',
        'attachment',
        'sender_type',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
