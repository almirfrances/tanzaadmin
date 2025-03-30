<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Users\Database\Factories\SocialLoginFactory;

class SocialLogin extends Model
{
    use HasFactory;

    protected $fillable = ['provider', 'client_id', 'client_secret', 'redirect_url', 'status'];
}
