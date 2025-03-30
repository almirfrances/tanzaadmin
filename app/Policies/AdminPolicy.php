<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    public function update(Admin $currentAdmin, Admin $admin)
    {
        return $currentAdmin->id === $admin->id;
    }
}
