<?php

declare(strict_types=1);

namespace App\Observers;

use App\Mail\AdminAnswerNotification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function created(User $user)
    {
        $admin = User::whereHas('role', function ($q) {
            $q->where('id', Role::ADMIN_ROLE_ID);
        })->first();
        Mail::to($admin)->send(new AdminAnswerNotification($user));
    }
}
