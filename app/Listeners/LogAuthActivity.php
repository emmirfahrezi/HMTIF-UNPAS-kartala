<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthActivity
{
    public function handleLogin(Login $event): void
    {
        $user = $event->user;

        ActivityLog::create([
            'user_id'     => $user->id,
            'action'      => 'login',
            'model_type'  => $user::class,
            'model_id'    => $user->id,
            'description' => "Login: {$user->email}",
        ]);
    }

    public function handleLogout(Logout $event): void
    {
        $user = $event->user;

        // user bisa null jika sesi sudah habis sebelum logout
        if (! $user) {
            return;
        }

        ActivityLog::create([
            'user_id'     => $user->id,
            'action'      => 'logout',
            'model_type'  => $user::class,
            'model_id'    => $user->id,
            'description' => "Logout: {$user->email}",
        ]);
    }
}
