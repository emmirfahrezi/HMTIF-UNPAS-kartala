<?php

namespace App\Services\User;

use App\Models\User;

class DeleteUserService
{
    public function execute(User $user): void
    {
        $user->delete();
    }
}
